@if($viewType == "Add")
  <script type="text/javascript">
      if ($('#name_ar').length) {

          var input1 = document.getElementById('name_ar');
          var input2 = document.getElementById('slug_ar');
          input1.addEventListener('change', function () {
              input2.value = input1.value;
          });
      }
      if ($('#name_en').length) {
          var input3 = document.getElementById('name_en');
          var input4 = document.getElementById('slug_en');

          input3.addEventListener('change', function () {
              input4.value = input3.value;
          });
      }
  </script>
@endif