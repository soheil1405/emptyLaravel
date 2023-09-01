<script type="text/javascript">
    $(document).ready(function() {
        $(".example1").pDatepicker({

            autoClose: true,
            onSelect: function(unix) {
                // console.log('datepicker select : ' + unix);
                var day = new persianDate(unix).toDate();
                // console.log('day :' + day);

                var standard = new Date(day).toISOString();

                console.log(standard);
                $('#date').val(standard);

            }
        });
    });





    // function showPic() {



        var imgInp = $('#question_img');
        var blah = $('#blah');


        imgInp.onchange = evt => {



            const file = imgInp.files[0];
            cosole.log(file);
            if (file) {
                blah.src = URL.createObjectURL(file)
                console.log(file);
            }else{
                console.log('no data');
            }
        }

    // }
</script>
