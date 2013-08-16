@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Home
@stop

@section('content')
<!-- replace the content below to suit your page content -->


<ul id="bxslider">
  <li><img src="assets/bxslider/images/pic (1).png" title="1" /></li>
  <li><img src="assets/bxslider/images/pic (2).png" title="2" /></li>
  <li><img src="assets/bxslider/images/pic (3).png" title="3" /></li>
  <li><img src="assets/bxslider/images/pic (4).png" title="4" /></li>
</ul>
<div id="bx-pager">
  <a data-slide-index="0" href=""><span id="s1">Buy And Sell Locally</span></a>
  <a data-slide-index="1" href=""><span id="s2">Sell on Amazon</span></a>
  <a data-slide-index="2" href=""><span id="s3">BookCheetah Delivery</span></a>
  <a data-slide-index="3" href=""><span id="s4">Get Started</span></a>
</div>

<div id="bottom">
  <div class="bottom-left">
    <div class="title-text">
      <span>Browse Popular Categories</span>
    </div>
    <div class="img img-book1">
      <div class="image-text">Biology</div>
    </div>
    <div class="img img-book2">
      <div class="image-text">Chemistry</div>
    </div>
    <div class="img img-book3">
      <div class="image-text">Economics</div>
    </div> <br />
    <!-- <div class="img-book"></div> -->
    <div class="img img-book4">
      <div class="image-text">Psychology</div>
    </div>
    <div class="img img-book5">
      <div class="image-text">Sociology</div>
    </div>
    <div class="img img-book6">
      <div class="image-text">Others</div>
    </div>
  </div>

  <!-- <div class="bottom-right"> -->
    <div id="video">
    <iframe width="100%" height="100%" 
      src="http://www.youtube.com/embed/_ugjlxl85w4?feature=player_detailpage"
      frameborder="0" allowfullscreen>
     </iframe>
    </div>
  <!-- </div> -->
  

</div>

@stop

@section('assets')
<!-- add your css and js here, dont add the jquery library again -->

    <link type="text/css" charset="utf-8" rel="stylesheet" media="screen" href="{{ asset('assets/styles/css/home.css')}}" />

    <!-- bxSlider Javascript file -->
    <script src="assets/bxslider/jquery.bxslider.js"></script>
    <!-- bxSlider CSS file -->
    <link href="assets/bxslider/jquery.bxslider.css" rel="stylesheet" />


    <script type="text/javascript" charset="utf-8">

        // $(window).load(function(){
          function bxslide(){

            $('#bxslider').bxSlider({
              auto: true,
              autoControls: false,
              nextSelector: '#slider-next',
              prevSelector: '#slider-prev',
              mode: 'fade',
              adaptiveHeight: true,
              infiniteLoop: true,
              speed: 3000,
              onSliderLoad: function(){
                 $('.bxslider .bx-prev').css('margin-left', '-3px');
               },
              onSlideAfter: function(){
                $('#bx-pager a').children().css('color', '#74662A');
                $('#bx-pager a.active').children().css('color', '#FFD100');
              },
              pagerCustom: '#bx-pager'
            });

            $('#bxslider2').bxSlider({
              auto: true,
              autoControls: false,
              adaptiveHeight: true,
              infiniteLoop: true,
              speed: 500,
              onSliderLoad: function(){
                 $('.bxslider2 .bx-viewport').css('position', 'absolute');
                 $('.bxslider2 .bx-next').css({'left':'15%', 'top':'60px', 'z-index':'1'});
                 $('.bxslider2 .bx-prev').css({'top':'60px', 'z-index':'1'});
               },
              onSlideAfter: function(){
                $('#bx-pager2 li a.btitle').css('color', '#74662A');
                $('#bx-pager2 li').css('color', '#74662A');
                $('#bx-pager2 li a.active').css('color', '#FFD100');
                $('#bx-pager2 li a.active').parent().css('color', '#FFD100');
                $('#bx-pager2 li span').css('display', 'none');
                $('#bx-pager2 a.active').parent('li').children('span').css('display', 'list-item');
              },
              pagerCustom: '#bx-pager2'
            });


            $('#dialog-form').dialog({
                title: "Add Book to your Bookshelf",
                autoOpen: false,
                width: 600,
                height: 600,
		            appendTo: ".content",
                modal: true,
                buttons: {
                  'Save': function() { $('#emailPost2').submit(); },
                  'Close': function() { $(this).dialog("close"); }      
                }
              });
            $('#dialog-form').css({'z-index': '2000'});

            $('.ui-dialog').css({
              'position': 'fixed',
              'top': '10px',
              'border-right': '10px',
              'width': '600px',
              'height': '80%',
              'top': '10px',
              'left': '0px',
              'right': '0px',
              'margin': 'auto',
            });
            //$('.ui-dialog-titlebar-close').click(function(e) { e.preventDefault(); $(this).dialog("close"); });

            $("a.bookshelf").click(function (e) {
              e.preventDefault();
              $( '#dialog-form' ).dialog( 'open' );
              $bdata = $('#bx-pager2 li a.active').parent();
              $book = {
                      'imgurl' : "http://localhost:8000/assets/bxslider/images/img-"+$bdata.children('a.active').attr('data-slide-index')+".jpg",
                      'title' : $bdata.children('a.active').text(),
                      'author' :  $bdata.children('span.author').text()
                      // 'publishdate' : '12:12:12',
                      // 'edition' : 'Latest n Greatest',
                      // 'isbn' : '1234567890asd',
                      // 'newprice' : '$2345',
                      // 'usedprice' : '$1234',
                      // 'amazonlink' : URL::to('users')
                      };
              $('#imgurl').attr('src', $book['imgurl']);
              $('#title').text($book['title']);
              $('#author').text($book['author']);
            });

            $("button.ui-button-text-only .ui-button-text").attr('class', 'btn btn-primary');
            //bootstrap blue button
          }

        // });

    </script>

@stop

