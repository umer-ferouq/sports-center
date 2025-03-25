<?php 
    $title = "";
    include("includes/header.php");
    include("includes/nav.php");
?>
<div class="container-fliud">
    <!-- Carousel Section -->
    <div class="carousel-section">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="max-height: 60vh">
                <div class="carousel-item active">
                    <img src="resource/pics/3d-trophy.jpg" class="d-block w-100" alt="..." style="width:100px">
                </div>
                <div class="carousel-item">
                    <img src="resource/pics/fade-bg.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="resource/pics/on-black.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="resource/pics/concept.jpg" class="d-block w-100" style="background-size: cover;
    position: relative;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="jumbotron">
        <h3>About Pantami Sports Center</h3>
        <p>Pantami Sports center is is website that allow Pantami stadium to manage it's sport's teams and other activities including organising tournaments or football leagues.</p>
    </div>
    <div class="row">
        <div class="Games" id="games">
            Games
        </div>
    </div>
    <div class="row">
        <div class="matches" id="matches">
            Matches
        </dIv>
    </div>
    <div class="row">
        <div class="Tour" id="tour">
            tournaments
        </div>
    </div>
    <div class="row">
        <div class="updates" id="up">
            Lifescore
        </div>
    </div>
</div>
<?php include("includes/footer.php")?>