      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- Menu Toggle Script -->
  <script>
    $(".hari").hide();
    
    $('#kelasku').on('click', function() {
      $('.hari').fadeToggle(300);
    });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
        $(".navbar-ku").addClass("sticky-top");
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        $(".navbar-ku").removeClass("sticky-top");
    });
  </script>

</body>

</html>
