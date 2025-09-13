$(document).ready(initialisePage);

function initialisePage() {
  $("input[name='search']").keyup(autoCompleteSearch);  
  $("input[name='search']").click(autoCompleteSearch);  
}

function autoCompleteSearch() {
  var search = $("input[name='search']").val().trim();  
  if (search != "") {
    $.get("getMachines_service.php?query=" + search, autoCompleteCallback);  
  } else {
    $("div#autocomplete-results").hide();  
  }
}

function autoCompleteCallback(results) {
  console.log(results);
  
  $("div#autocomplete-results").empty();
  
  for (var i = 0; i < results.length; i++) {
    var result = $('<div class="result-item">' + results[i].machineName + '</div>');
    
    result.click(function() {
      $("div#autocomplete-results").hide();
      $("input[name='search']").val($(this).text());
      $("#searchForm").submit();
    });
    
    $("div#autocomplete-results").append(result);
  }
  
  if (results.length == 0) {
    $("div#autocomplete-results").hide();
  } else {
    $("div#autocomplete-results").show();
  }
}