$.ajax({
    type: 'POST',
    dataType: "json",
    url:'webhooks.php',
    data: "test",
    success: function(data)
    {
     try {
        data = JSON.parse(data);
      }catch(e) {}
      console.log(data);
    }
  });