
<!DOCTYPE html>
<html lan="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fishermans Mission - Example Blackbaud Integration</title>
  <link rel="shortcut icon"  href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</head>
<div class="container">
  <div class="row">
    <div class="col-md-1">
      <a href="/auth/login.php" class="btn btn-primary">Log in</a>
    </div>
    <div class="col-md-1">
      <a href="/auth/logout.php" class="btn btn-primary">Log out</a> 
    </div>
    <div class="col-md-1">
      <a href="/auth/refresh-token.php"  class="btn btn-primary">Refresh Access Token</a> 
    </div>
  </div>
</div>
<form action="api/constituentactions.php" method="post">
  <div class="container">
  <div class="row">
      <div class="col-md-12"> 
        <label for="constituent_id">Deceased Client List</label>
        <input list="constituent_id_list" id="constituent_id" name="constituent_id" />
             
      <datalist id="constituent_id_list">
          
      </datalist>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12"> 
        <label for="date">Funeral activity date</label>
        <input type="date" name="date" id="date">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"> 
        <label for="start_time">Funeral activity start time</label>
        <input type="time" name="start_time" id="start_time">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"> 
        <label for="end_time">Funeral activity end time</label>
        <input type="time" name="end_time" id="end_time">
      </div>
    </div>    
    <div class="row">
      <div class="col-md-12"> 
        <label for="funeralactivity">Funeral activity being provided</label>
        <select name="funeralactivity" aria-required="true" aria-invalid="false"><option value="">---</option><option value="Conducting service">Conducting service</option><option value="Eulogy">Eulogy</option><option value="Tribute">Tribute</option><option value="Reading">Reading</option><option value="Scattering of ashes">Scattering of ashes</option><option value="Internment of ashes">Internment of ashes</option><option value="Conducting memorial service">Conducting memorial service</option></select>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12"> 
        <label for="summary">Funeral activity summary</label>
        <input type="text" name="summary" id="summary">
      </div>
    </div>

    <input type="hidden" name="category" value="Task/Other">

    <div class="row">
      <div class="col-md-12"> 
        <label for="missionrepresentative">Mission Representative</label>
        <select name="missionrepresentative" class="" aria-invalid="false"><option value="Hull MAO">Hull MAO</option></select>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12"> 
        <button type="submit">Submit</button>
      </div>
    </div>

    
    
  </div>
    <input type="hidden" name="priority" value="Normal">
    <!-- <input type="hidden" name="type" value ="Client Funeral Conducted"> -->
    <input type="hidden" name="direction" value="Outbound">
    <input type="hidden" name="completed" value="false">
    <input type="hidden" name="outcome" value="Successful">
    <input type="hidden" name="status" value="Booked">
  
</form>


<script>

function fillConst(){
  $.ajax({
    type: 'GET',
    url: "/api/constituents.php?all=true",
    datatype: 'json',
    success: function(datas) {
      $.each(JSON.parse(datas), function(i, data) {

        console.log(data)
        $("#constituent_id_list").append("<option value='" + 
          data.address.constituent_id + "'>" + data.name + "</option>");
      })
    }
  })
}

fillConst();

</script>
</body>
</html>
