        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2024 by eCodeSoft Solutions. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
            </div>
          </footer> 
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>   
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
  
    <!-- plugins:js -->
    <script src="{{asset('AdminDashboard/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('AdminDashboard/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('AdminDashboard/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('AdminDashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('AdminDashboard/js/dataTables.select.min.js')}}"></script>
  
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('AdminDashboard/js/off-canvas.js')}}"></script>
    <script src="{{asset('AdminDashboard/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('AdminDashboard/js/template.js')}}"></script>
    <script src="{{asset('AdminDashboard/js/settings.js')}}"></script>
    <script src="{{asset('AdminDashboard/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('AdminDashboard/js/dashboard.js')}}"></script>
    <script src="{{asset('AdminDashboard/js/Chart.roundedBarCharts.js')}}"></script>
    <!-- End custom js for this page-->

    <!--For Searching and sorting-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable({
          "lengthMenu": [ [3, 5, 10, 25], [3, 5, 10, 25] ],
        });
      });
    </script>
  </body>
  
  </html>