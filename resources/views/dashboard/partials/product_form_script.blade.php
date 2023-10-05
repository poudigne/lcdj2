<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();

        var player_range = $("input#player_range").bootstrapSlider({
            id: "player_slider",
            min: 1, max: 20,
            range: true,
            value: [{{ $product->min_player == "" ? 2 : $product->min_player }}, {{ $product->max_player == "" ? 6 : $product->max_player }}]
        }).on('slide', update_player_number);

        var age_range = $("input#age_range").bootstrapSlider({
            id: "age_slider",
            min: 0, max: 18,
            value: {{ $product->min_age == "" ? 12 : $product->min_age }}
            }).on('slide', update_age_number);

        update_player_number();
        update_age_number();

    });
    var update_range = function(elementId, rangeValue, customText){
        var values = rangeValue.split(",")
        $(elementId+"-min").val(values[0]);
        $(elementId+"-max").val(values[1]);
        $(elementId).html(customText.replace('%min',values[0]).replace('%max',values[1]).replace('%age',values[0]));
    };
    var update_player_number = function() {
        update_range("#input-players", player_range.value, "%min to %max players");
    };
    var update_age_number = function() {
        update_range("#input-age", age_range.value, "%age years +");
    };
    $(".thumbnail").hover(function(){
        $(this).find("button").css('visibility', 'visible')
    },function(){
        $(this).find("button").css('visibility', 'hidden')
    });

    $("button.btn-delete-image").click(function(){
        var link = $(this).attr('href');
        var media_id = $(this).parents().closest('div[data-field-media]').attr('data-field-media');
        var product_id = $(this).parents().closest('div[data-field-product]').attr('data-field-product');
        $.ajax({
            url: link,
            type: "post",
            data: {
                "product_id"  : product_id,
                "media_id"  : media_id,
                "_token" : "{{ csrf_token() }}"
            },
            dataType: "json"
        }).done(function(response){
            toastr["success"]("The "+response.model_type+" has been successfuly deleted!","Success !");
        }).fail(function(response){
            toastr["error"]("{{ session('error') }}","Error !");
        }).always(function(response) {
            $("#medias-thumbnail").find("div.thumbnail[data-field-media='"+response+"']").parent().remove();
        });
    });
</script>