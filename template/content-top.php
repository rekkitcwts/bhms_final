</div>
<script type="text/javascript">
var currentTime = new Date().getHours();
if (5 <= currentTime && currentTime < 6) {
	// Dawn
    if (document.body) {
        document.body.background = "./img/timebased/dawn.jpg";
    }
}
if (6 <= currentTime && currentTime < 8) {
	// Sunrise
    if (document.body) {
        document.body.background = "./img/timebased/sunrise.jpg";
    }
}
if (8 <= currentTime && currentTime < 15) {
	// Noon
    if (document.body) {
        document.body.background = "./img/timebased/noon.jpg";
    }
}
if (15 <= currentTime && currentTime < 17) {
	// Afternoon
    if (document.body) {
        document.body.background = "./img/timebased/afternoon.jpg";
    }
}
if (17 <= currentTime && currentTime < 20) {
	// Sundown
    if (document.body) {
        document.body.background = "./img/timebased/sundown.jpg";
    }
}
else {
	// Night
    if (document.body) {
        document.body.background = "./img/timebased/night.jpg";
    }
}

</script>
<div class="content content-body">
<h1><span class="boxshadow c1">
<?php echo $page_title; ?>
</span></h1>