@php 
  $prog_footer = env('prog_footer');
  @endphp
  <footer class="app-footer">
      <div class="container text-center py-3">
          {!! $prog_footer !!}   
      </div>
    </footer>
    
    </div>					
  
    <script>
      $(function(){
          $("#page_title").html('{{ $page_title }}');
      });
    </script>
    </body>
    </html> 
   
        <script>
        $("#modal-pass").on("show.bs.modal", function (e) {
          var button = $(e.relatedTarget);
          var modal = $(this);
          modal.find(".modal-body-pass").load(button.data("remote"));
        }); 
      </script>
      <script>$(function(){xinput();}); </script>        
		