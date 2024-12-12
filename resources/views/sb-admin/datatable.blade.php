<script src="{{asset('/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('/js/dataTables/datatable-jquery.js')}}"></script>
<script src="{{asset('/js/dataTables/datatable-boostrap.js')}}"></script>
<script src="{{asset('/js/dataTables/moment.min.js')}}"></script>
<script src="{{asset('/js/dataTables/dateTime.min.js')}}"></script>
<script>
 let minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 DataTable.ext.search.push(function (settings, data, dataIndex) {
     let min = minDate.val();
     let max = maxDate.val();
     let date = new Date(data[3]);
  
     if (
         (min === null && max === null) ||
         (min === null && date <= max) ||
         (min <= date && max === null) ||
         (min <= date && date <= max)
     ) {
         return true;
     }
     return false;
 });
  
 // Create date inputs
 minDate = new DateTime('#min', {
     format: 'YYYY-MM-D'
 });
 maxDate = new DateTime('#max', {
     format: 'YYYY-MM-D'
 });
  
 // DataTables initialisation
 let table = new DataTable('#example');
  
 // Refilter the table
 document.querySelectorAll('#min, #max').forEach((el) => {
     el.addEventListener('change', () => table.draw());
 });
</script>