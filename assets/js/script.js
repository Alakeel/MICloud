// The Acess Token Can Be taken from Instagram Developer Page
//http://instagram.com/developer/authentication/

var access_token = "8858012.1677ed0.e6dc50cb28c5416aaa4d30a2ed7c2ee3"; 
var resolution = "standard_resolution"; // the resolution: low_resolution, thumbnail, standard_resolution
var last_url = "";

function clearBox(elementID) {
    document.getElementById(elementID).innerHTML = "";
}

function myFunction() {
    
     var hashtag = document.getElementById("myText").value;

    if(hashtag != ""){


    clearBox("instagram");
    $("#instaHead").show();

    // var hashtag = 'test';
    var start_url = "https://api.instagram.com/v1/tags/" + hashtag + "/media/recent/?access_token=" + access_token;

    //CALL THE SCRIPT TO START...
    $(document).ready(function () {

        //APPEND LOAD MORE BUTTON TO THE BODY...
        $("#more").unbind('click').click(function () {
            console.log("Clicked More");
            var next_url = $(this).attr('next_url');
           loadImages(next_url);
            return false;
        });

        //start your engines
        loadImages(start_url);

    });
}
}

function loadImages(next_url) {

    url = next_url;

    $(function () {
        $.ajax({
            type: "GET",
            dataType: "jsonp",
            cache: false,
            url: url,
            success: function (data) {

                next_url = data.pagination.next_url;

                count = 5;
                for (var i = 0; i < count; i++) {
                    if (typeof data.data[i] !== 'undefined') {
                        a = data.data[i].images.standard_resolution.url;
                        $("#instagram").append("<div class='instagram-wrap' id='pic-" + data.data[i].id + "' >" +
                            "<a target='_blank' href='" + data.data[i].link + "'><span class='likes'>" + data.data[i].likes.count + "</span>" +
                            "<img class='instagram-image' src='" + data.data[i].images.standard_resolution.url + "' />" +
                            "</a><br/>" +
                            "<a href='" + a + "' download='.jpg'><button class='btn' type='button'>Download</button></a></div>"
                        );
                    }
                }

                console.log("next_url: " + next_url);

                $("#showMore").hide();
                if (typeof next_url === 'undefined' || next_url.length < 10) {
                    console.log("NO MORE");
                    $("#showMore").hide();
                    $("#more").attr("next_url", "");
                }


                else {
                    //set button value
                    console.log("displaying more");
                    $("#showMore").show();
                    $("#more").attr("next_url", next_url);
                    last_url = next_url;
                    }
            }
        });
    });
}

