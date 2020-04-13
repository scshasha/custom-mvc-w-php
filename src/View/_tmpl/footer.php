                </div>
                <!-- /#content -->
                <div id="footer" class="text-center mt-5">
                    <div class="container">
                        <div class="copy-right pt-4">
                            <p class="text-center">
                                &copy;<?=date('Y')?> All rights reserved.
                            </p>
                        </div>
                        <img draggable="false" style="-moz-user-select: none;" src="https://www.singles2meet.co.za/images/made_in_sa2-min.png" class="img text-center" />

                    </div>  
                </div>
                <!-- /#footer -->
            </div>
            <!-- /#container --> 
        </div>
        <!-- /#wrapper -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--        <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>-->
<!--        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
<!--        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
        <script type="text/javascript" src="<?= $this->makeURL("assets/lib/jquery/jquery-3.4.1.js")?>"></script>
        <script type="text/javascript" src="<?= $this->makeURL("assets/lib/popper/js/popper-1.16.0.min.js")?>"></script>
        <script type="text/javascript" src="<?= $this->makeURL("assets/lib/bootstrap/js/bootstrap-4.4.1.min.js")?>"></script>

        <?php $this->getJS(); ?>
    </body>
</html>