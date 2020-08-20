@auth
       
@else
<script>
window.location.href = "{{ url('login') }}";
</script>
@endauth