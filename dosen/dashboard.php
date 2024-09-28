<?php 
// New query to get course names based on the logged-in dosen
$dosen_username = $_SESSION['username'];
$course_query = mysqli_query($conn, "
    SELECT DISTINCT course.kode_mk, course.nama_mk
    FROM course
    JOIN dosen ON dosen.kode_mk = course.kode_mk
    WHERE dosen.username = '$dosen_username'
");
?>

<div class="main-panel">
    <div class="content" style="background-position:center">
        <div class="page-inner">
            <div class="row">
                <!-- Loop through courses and create a card for each -->
                <?php while ($course = mysqli_fetch_array($course_query)): ?>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Mata Kuliah</p>
                                        <h4 class="card-title">
                                            <a href="absen.php?kode_mk=<?php echo $course['kode_mk']; ?>">
                                                <?php echo $course['nama_mk']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
