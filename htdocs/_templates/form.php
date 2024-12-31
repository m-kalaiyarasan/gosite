
<section id="upload" class="upload-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Launch Your Websites <i class="fa fa-rocket" style="font-size:48px;color:rgb(255, 62, 62)"></i>
            </h2>
            <div class="upload-area mx-auto">
                <div class="upload-content">
                    <i class="bi bi-cloud-upload"></i>
                    <form action="uploadtest.php" method="POST" enctype="multipart/form-data">
        <h6>Enter Domain Name</h6>
        <input class="form-control" type="text" id="domain" name="domain" required placeholder="" />
        <br><br>

        <h6>Upload Your Project: (.zip)</h6>
        <input type="file" class="form-control form-control-lg" id="file" name="file" accept=".zip" />
        <br><br>
        <!-- <button type="submit" class="btn btn-primary">Deploy Now</button> -->
        <button type="button" class="btn btn-primary" onclick="window.location.href='dashboard.php?host';">Deploy Now</button>
        </form>
               </div>
            </div>
        </div>
    </section>
