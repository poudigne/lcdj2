<ol class="breadcrumb">
<script type="text/javascript">

    var path = "{{ Request::path() }}";
    var pathList = path.split('/');
    var arrayLength = pathList.length;
    var url = "";
    for (var i = 0; i < arrayLength; i++) {
        url += pathList[i]+ "/"
        if (i == arrayLength -1)
            $(".breadcrumb").append("<li class='active'>"+pathList[i]+"</li>")
        else
            $(".breadcrumb").append("<li><a href=\"/"+url+"\">"+pathList[i]+"</a></li>")
    }

</script>
</ol>
