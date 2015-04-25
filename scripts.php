<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script>
var latest = null;
(function poll() {
    setTimeout(function() {
        $.ajax({
            url: 'update.php',
	    method: 'POST',
	    data: {
	        latest: latest
            },
	    success: function(data) {
	        var html = "";
		console.log(data);
	    	for (var i = 0; i < data.updates.length; i++) {
		    var u = data.updates[i];
		    html += "<li>" + u.name + " rated " + u.title + " " + u.rating + "/10</li>";
		}
		console.log(html);
                $('#updates').html(html);
		latest = data.latest;
            },
	    complete: poll,
	    dataType: 'json'
        });
    }, 1000);
})();
</script>