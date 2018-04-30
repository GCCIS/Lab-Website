// Contains entire list of TAs for use in filtering
var TAList = $('.TACard').clone()

$('.signoffSelector').change(function () {
  var signoffSelectorRow = $('.signoffSelectorRow') // Need to add this to the emptied container

  // Get the signoff to search for
  var signoffToDisplay = $(this).find('option:selected').val()

  // Will hold all newly created TAs to be appended to profiles container
  var newTAs = document.createElement('div')
  $(newTAs).addClass('container')
  $(newTAs).append(signoffSelectorRow)

  // Row to hold newly created TAs
  var row = document.createElement('div')
  $(row).addClass('row')

  var cardsAdded = 0 // Tracks the cards per row
  for (var i = 0; i < TAList.length; i++) {
    // Get the signoffs for the TA in the card, remove spaces, and split on ,
    var signoffs = $(TAList[i]).find('.TAMajor').attr('data-class-signoffs')
    signoffs = signoffs.replace(/\s+/g, '')
    signoffs = signoffs.split(',')

    // Skip the TA if they can't signoff for the class we want or if we want all TAs
    if (signoffToDisplay !== 'All' && !signoffs.includes(signoffToDisplay)) {
      continue
    } else {
      // Create a new bootstrap column and append the previously stored TA card
      var column = document.createElement('div')
      $(column).addClass('col-xs-12 col-sm-10 col-md-6')
      $(column).append(TAList[i])
      $(row).append(column)

      cardsAdded += 1 // Increment the number of cards that we have added to the row
    }

    // Append the row if we have two per row OR if this is the last TA card.
    if (cardsAdded % 2 === 0 || i === TAList.length - 1) {
      $(newTAs).append(row)
      row = document.createElement('div')
      $(row).addClass('row')
    }
  }

  // Account for there only being one match
  if (cardsAdded === 1) {
    $(newTAs).append(row)
  }

  // Clear out the existing TA container and append the new ones
  $('.profiles .container').remove()
  $('.profiles').append(newTAs)
})
