<?php include 'header.php' ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 offset-lg-3 col-md-6">

                <form action="#" id="init-sse">
                    <label for="a">Zadajte konštantu a:</label>
                    <input type="number" id="a" class="form-control" name="a" value="1" required>
                    
                    <div class="custom-control custom-switch">
                    
                        <input type="checkbox" class="custom-control-input" id="sin" name="sin">
                        <label class="custom-control-label" for="sin">Toggle sin</label>
                    </div>
        
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="cos" name="cos">
                        <label class="custom-control-label" for="cos">Toggle cos</label>
                    </div>
        
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="cossin" name="cossin">
                        <label class="custom-control-label" for="cossin">Toggle cos sin</label>
                    </div>
        
                    <input type="submit" value="Submit" class="btn btn-block btn-danger">
                </form>
            </div>
        </div>

        <div id="data"></div>


    </div>
</main>

<?php include 'footer.php' ?>
