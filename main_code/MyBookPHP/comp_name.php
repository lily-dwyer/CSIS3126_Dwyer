<?php
    include("global.php");
    include("header.php");
?>
 <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">What is your Company Name</h3>
                                        <p></p>
                                
                                    <div class="card-body">
                                    <form action="process_reg.php" method="POST">
                                        <input type="hidden" name="id" value="<? echo $id; ?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="comp_name" id="comp_name" type="text" placeholder="Enter your company name" value="<?php echo $comp_name;?>"/>
                                                        <label for="comp_name">Company Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
</div>



<?php 
    include("footer.php");
?>