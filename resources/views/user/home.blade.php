@extends('user/master_layout') @section('data')

@php  
$audio='';
$lastverse='';
@endphp

<div id="wait" style="display: none;"></div>

<section id="home_content" >
  
  <div class="container-fluid" >

   <div class="row mt-5" >
   
    <div class="col-sm-6 left" id="tran-side">
      <p class="text-center"  dir="ltr">
        <span class="trns" style="color: #99cc33"><span id="sura_nm">{{ $surah->surah_name }}</span></span>
      </p>
      <p class="text-center"  dir="ltr">
        <span class="trns" style="color: #99cc33">I Allahs navn, den Barmhjertige, den Nåderike</span>
      </p>
      
     <p id="translation">

      @foreach ($surah->verse as $verse)
        <span  class="trns" id="trans{{$verse->verse}}"> {{$verse->translation}}</span>
        <img src="{{$PUBLIC_ASSETS}}/img/ayah-end.png" class='ayah-end'>
        <span style="padding: 5px;">{{$verse->verse}}</span>
        @if($audio=='')
        <?php $audio=$verse->link_to_audio; ?>
        @endif
      @endforeach 

    </p>
  </div>
  <div class="col-sm-6 right" id="arab-side">

    <p class="text-center" dir="rtl">
      <span class="arbic" style="color: #99cc33">سُوۡرَةُ  <span id="sura_n">{{ $surah->surah_name_arabic }}</span> </span>
    </p>
    <p class="text-center"  dir="rtl">
      <span class="arbic" style="color: #99cc33">بِسۡمِ ٱللَّهِ ٱلرَّحۡمَـٰنِ ٱلرَّحِيمِ</span>
    </p>
   <p class="pull-right" id="arabic" dir="rtl">
       @foreach ($surah->verse as $verse)
        <script type="text/javascript">
          c_obj['verse_id' + {{ $verse->verse }}] = '{{ $verse->verse }}';
          c_obj['arb_link' + {{ $verse->verse }}] = '{{ $verse->link_to_audio }}';
          c_obj['arb_desc' + {{ $verse->verse }}] = '{!! str_replace('<br />', '\\', $verse->description) !!}';
        </script>
        <span class="arbic" id="arabic{{$verse->verse}}"> {!!$verse->arabic_immune!!} </span><img src="{{$PUBLIC_ASSETS}}/img/ayah-end.png" class='ayah-end'> <span style="padding: 5px;">{{$verse->verse}}</span>
       @endforeach
     

   </p>

 </div>

</div>

</div>
<div class="row">
  <div class="col-md-12">
    
    <div class="footerDrawer">
      <div data-toggle="tooltip" data-placement="top" class="open">
        <!-- remved title="Verse Footnotes" from above tag -->
        <img src="{{$PUBLIC_ASSETS}}/img/triangle.svg" alt="" class='triangle'>
      </div>
      <div class="content">
        <div class="row container">
          <div class="col-md-12">
            <a href="javascript:;" style="color:#214300;" data-toggle="modal" data-target="#footnotes">

              <p class="c-verse" style="font-size: 12px">No Footnote provided</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-header-section footer">
  
 <div class="container">

  <div class="row">

   <div class="page-header-area">
    <div class="page-header-content " >

     <section class="audio_player">
      <section class="control_panel">
       <section class="extra_button">
        <a href="#" onclick="zoomout()" class="zoom_text minus_size vertical" title="Zoom Out">
          <img src="{{$PUBLIC_ASSETS}}/img/zoomout.png">                       
        </a>
        <a href="#" onclick="zoomin()"  class="zoom_text vertical" title="Zoom In">
          <img src="{{$PUBLIC_ASSETS}}/img/zoomin.png" class="zoomin">                       
        </a>
      </section>
      <section class="main_control">
        <a href="#" class="stop_b" title="Stop" onclick="stop_player()">
          <img src="{{$PUBLIC_ASSETS}}/img/stop.png"></a>
          <a href="#" class="play_b" title="Play/Pause">
           <div style="padding-left:2.2px;">
            <div id="buf_2" class="cp-buffer-2" style="clip: rect(48px, 24px, 48px, 0px);">
            </div>
            <div id="buf_1" class="cp-buffer-1" style="clip: rect(0px, 48px, 0px, 24px);">
            </div>
          </div>

          <div id="playbtn">
            <button id="play_btn" onclick="playPause()" class="paused"></button>
            <span id="payer_area">
              <audio id="myAudio" onended="audio_player();">
                <source src="" id="audio_source" type="audio/mpeg">
              </audio>
              </span>
            </div>
          </a>
          <audio id="next-audio">
            <source src="{{$ADMIN_ASSETS}}/audios/{{ $surah->verse[0]->link_to_audio }}" id="next-audio-src" type="audio/mpeg">
          </audio>
          <a id="btnPrevious" class="pre_b" onclick="previousSurah()" title="Previous Sura"> <img src="{{$PUBLIC_ASSETS}}/img/rewind.png">
          </a>
          <a id="btnNext" class="next_b" onclick="nextSurah()" title="Next Sura"> <img src="{{$PUBLIC_ASSETS}}/img/forward.png"> </a>
        </section>
        <section class="extra_button barBox2">
          <a href="#" data-toggle="tooltip" data-placement="top" title="Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text " rel="#bookmark_Scr" onclick="save_bookmarks()" id="_myBookMark" class="book_mark">
           <!-- <img src="{{$PUBLIC_ASSETS}}/img/bookmark.jpg"> -->
           <!--<output class="but_title">Save Bookmark</output>-->
           <object data="{{$PUBLIC_ASSETS}}/img/bookmark.svg" type="image/svg+xml"></object>
         </a>
       </section>

     </section>

   </section>

 </div>
</div>
</div>
</div>
</div>
</section>
<section id="search_content" style="display: none;">
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3>Search Results</h3>
            <hr>
            <ul class="unstyled-list mb-2">
              {{--               <li>Current Rage : 1 - 10</li> --}}
              <li><span id="total_found"> </span></li>
            </ul>
            <span id="results">

            </span>


          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<section id="bookmark_content" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3>Bookmarks</h3><span id="" style="color:#9c3;"></span>
            <hr>
            <form id="get_bookmarks" class="shake" role="form" method="post">
             @csrf
             <div class="form-group">
              <input type="email" placeholder="Enter Your Email" id="get_bookmarks_email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" class="btn btn-primary" value="Get Bookmarks">
              <input class="btn btn-del-bookmark" type="" name="" value="Delete Bookmark">
            </div>
          </form>

          <ul class="unstyled-list mb-2">
            {{--               <li>Current Rage : 1 - 10</li> --}}
            <li><span id="total_found_bookmarks"> </span></li>
          </ul>
          <span id="results_bookmarks">

          </span>
        </div>
      </div>
    </div>
  </div>

</div>
</section>
<section id="inv_friend_content" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3>Invite Friend </h3>
            <span id="invite_results" style="color:#9c3;font-size:20px;"></span>
            <hr>
            <div class="form-group">
              <form id="form" class="shake" role="form" method="post">
               @csrf
               <input type="text" name="name" placeholder="Your name" class="contact-control form-control" required="" >
             </div>
             <div class="form-group">
              <input type="email" placeholder="Your email" name="sender_email" class="form-control" required="">
            </div>
            <div class="form-group">
              <input type="email" name="receiver_email" placeholder="Friend's email" class="form-control" required="">
            </div>
            <div class="form-group">
              <textarea class="form-control" placeholder="Message" name="message" required=""></textarea>
            </div>
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" value="Send Invitation" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</section>
<section id="bug_report" style="display: none;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mr-auto">
        <div class="jumbotron jumbotron-fluid pt-2">
          <div class="container-fluid">
            <h3>Bug Reporting </h3>
            <span id="report_results" style="color:#9c3;font-size:20px;"></span>
            <hr>
            <div class="form-group">
              <form id="form_bug_report" class="shake" role="form" method="post">
               @csrf
               <input type="text" name="name" placeholder="Your name" class="contact-control form-control" required="" >
             </div>
             <div class="form-group">
              <select class="form-control" name="erorr_script">
                <option selected="">Select</option>
                <option value="Arabic Text">Arabic Text</option>
                <option value="Arabic Audio">Arabic Audio</option>
                <option value="Norsk Translation">Norsk Translation</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="summery" placeholder="Summary" class="form-control" required="">
            </div>
            <div class="form-group">
              <textarea class="form-control" placeholder="Details" name="details" required=""></textarea>
            </div>
            {{-- <div class="form-group">


              <div id="captcha">
                <div class="controls">
                  <input class="form-control" placeholder="Type here" type="text" />
                  <input value="Check" type="button" class="validate btn-common">
                  <!-- this image should be converted into inline svg -->
                  <input value="Reload" type="button" class="refresh btn-common">
                  <!-- this image should be converted into inline svg -->
                </div>
              </div>
            </div> --}}
            <div class="form-group">
              <label id="Surah_b_id"></label>,&nbsp;&nbsp;&nbsp;&nbsp;
              <label id="verse_b_id"></label>,&nbsp;&nbsp;&nbsp;&nbsp;
              <label id="recitor_b_id"></label>
            </div>
            <input type="hidden" value="" id="Surah_b_id_in" name="surah_id">
            <input type="hidden" value="" id="from_verse_b_id_in" name="from_verse">
            <input type="hidden" value="" id="to_verse_b_id_in" name="to_verse">
            <input type="hidden" value="" id="recitor_b_id_in" name="recitor_id">
            <div class="form-group">
              <input style="height: auto; width: auto;" type="submit" name="btnSub" value="Send" class="btn btn-primary">
            </div>
            <span id="results_report"></span>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</section>
{{-- 
<audio controls autoplay >
   @foreach($surah->verse as $verse)
   <source src="{{$ADMIN_ASSETS}}/audios/{{$verse->link_to_audio}}" type ="audio/mp3">
   @endforeach;
</audio>
--}}
@endsection
@push('css')
{{-- 
<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/bootstrap.min.css">
--}} 
<style type="text/css">
.footer{
 position: fixed;
 bottom: 0;
}
#wait {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('{{$PUBLIC_ASSETS}}/img/loader.gif') 50% 50% no-repeat rgba(249,249,249,0.7);
  background-size: 150px 150px;
}

.footnote-modal-btn {
      border-radius: 5px;
    height: 43px;
    background-color: #83ab33;
    /* border: 2px solid; */
    /* box-shadow: none; */
    border: none;
    padding: 0px 5px;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/style_nav.css">
<link rel="stylesheet" href="{{ $PUBLIC_ASSETS }}/sweetalert/dist/sweetalert.css">
{{-- <link rel="icon" type="image/png" href="favicon.ico">
<link rel="apple-touch-icon" href="apple-touch-icon.png">    
--}}
<script type="text/javascript">
  var c_obj = {};
  var myAudio = [];
</script>
@endpush 
@push('js')
<script src="{{ $PUBLIC_ASSETS }}/sweetalert/dist/sweetalert.js"></script>
{{-- <script src="{{$PUBLIC_ASSETS}}/captcha/client_captcha.js" defer></script>
--}}

<div class="modal fade" id="footnotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content" style="margin-top: 115px;">
<div class="modal-header">
<h5 class="modal-title tb-modal-title" id="exampleModalLabel">Verse Footnotes</h5>
</div>
<div class="modal-body">

<div class="form-group">
 
 <p class="c-verse" style="font-size: 12px">No Footnote provided</p>
 
</div>
<div class="pull-right">
<button type="button" class="footnote-modal-btn" data-dismiss="modal">Close</button>

</div>
<div class="clearfix"></div>

</div>
</div>
</div>
</div>

<script type="text/javascript">
   
  // console.log(c_obj);
 $("body").tooltip({
    selector: '[data-toggle="tooltip"]'
});
 $('#cmbScript').on('change' , function(){
  v = $(this).val();
  if(v == 'hide'){
    $('#arab-side').hide();
    $('#tran-side').removeClass('col-sm-6 left').addClass('col-sm-12');
  }else if(v == 15){
    $('#arab-side').show();
    $('#tran-side').removeClass('col-sm-12').addClass('col-sm-6 left');
  }
 });
 $('#cmbTranslation').on('change' , function(){
  v = $(this).val();
  if(v == 'hide'){
    $('#tran-side').hide();
    $('#arab-side').removeClass('col-sm-6 right').addClass('col-sm-12');
  }else if(v == 9){
    $('#tran-side').show();
    $('#arab-side').removeClass('col-sm-12').addClass('col-sm-6 right');
  }
 });
 st_ver = 1;
  $(function () {
   $('#form_bug_report').on('submit',function (e) {
     e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/save_bug_report') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {
                  if(response!=0 && response!=2)
                  {
                    $('#results_report').html('<span style="color:green;">Your Bug is submitted for review and bug id is ['+response+']</span>')
                  }
                  else
                  {
                    $('#results_report').html('<span style="color:red;">Something went wrong. Please try again.</span>')
                  }
                }
              });
      });
 });
 // document.addEventListener("DOMContentLoaded", function() {
 //        document.body.scrollTop; //force css repaint to ensure cssom is ready

 //        var timeout; //global timout variable that holds reference to timer

 //        var captcha = new $.Captcha({
 //          onFailure: function() {
 //           alert("wrong!!!");

 //         },

 //         onSuccess: function() {
 //          alert("CORRECT!!!");
 //        }
 //      });

 //        captcha.generate();
 //      });

// var aud = document.getElementById("myAudio");
// aud.onended = 
var next_play=false;
var equal_check=false;
var repeat_num = ''; 
var repeat_range = '';
var start_verse = ''; 
var t_ver = 0;
var is_ended = false;
t_ver = '{{ $surah->verses }}';
t_ver = parseInt(t_ver);
function audio_player() {

  var surah_id = $('#cmbSura').val();
  var current_verse_id = $('#cmbFVerse').val();
  // alert(current_verse_id);
  var limit_verse = $('#cmbTVerse').val();
  repeat_num=$('#cmbVerseRepeat').val();
  repeat_range=$('#cmbRangeRepeat').val();
  var verse_no = current_verse_id;

  if(start_verse=='')
  {
    start_verse=current_verse_id;
  }
  if(equal_check){
    start_verse='';
    assign_temp();
    return;
  }
  if(current_verse_id=={{$surah->verses}})
  {
    start_verse='';
    assign_temp();
    return;
  }
  if(next_play)
  {
    current_verse_id = eval(current_verse_id)+eval(1);
  }
  else
  {

    next_play=true;
  }

  var id = eval(current_verse_id)-eval(1);
  $("#arabic"+id).css("background-color", "white");
  $("#trans"+id).css("background-color", "white");
  //$('#cmbFVerse').val(current_verse_id+1);

    // if(typeof c_obj['verse_id' + current_verse_id] === 'undefined') {
    //   does not exist
    //   alert('not');
    // }
    // else {
    //     alert('yes');
    // }
    // alert(eval('c_obj.arb_link'+ current_verse_id));
    c_cur_verse_elem = eval('c_obj.verse_id'+ current_verse_id);
    if(c_cur_verse_elem == t_ver){
      is_ended = true;
    }

    var link = "{{$ADMIN_ASSETS}}/audios/"+eval('c_obj.arb_link'+ current_verse_id);
    console.log(link);
    $('#cmbFVerse').val(c_cur_verse_elem);
    $('.c-verse').html(eval('c_obj.arb_desc'+ current_verse_id).replace(/\\r\\n/g, "<br />"));
    if(limit_verse==c_cur_verse_elem)
    {
      equal_check=true;
    }
    var audio = $('#myAudio').get(0);
    $("#arabic"+c_cur_verse_elem).css("background-color",$('#cmbBColor').val());
    $("#trans"+c_cur_verse_elem).css("background-color",$('#cmbBColor').val());
    $("#audio_source").prop('src', link);
    audio.load();
    audio.play();
    if(repeat_range==1)
    {

       var range =1;
    }
    if(repeat_num >1 && repeat_range>=verse_no)
      {
         // alert(repeat_num);
        var count = 2;

       audio.onended = function()
        {

        if(count<=repeat_num && repeat_range>=range){
          count++;
          range++;
            this.play();
          // if(repeat_range>1)
          // {
          //   repeat_range--; 
          // }
          // else
          // {
          //   audio_player();   
          // }
        }
        else
        {
          audio_player();
        }
      };
    }
    
//   $.ajax({
//    url:'{{ url('/get-next-audio') }}',
//    type: 'post',
//    data: {
//      "_token": "{{ csrf_token() }}",
//      "surah_id" : surah_id,
//      "current_verse_id" : current_verse_id,
//    },
//    beforeSend: function(){
//     document.getElementById("wait").style.display = "block";
//   },
//   complete: function(){
//   },
//   success: function (response) 
//   {
//     document.getElementById("wait").style.display = "none";
//     var returnedData = JSON.parse(response);
//     if(returnedData.f == 'true'){
//       var link = "{{$ADMIN_ASSETS}}/audios/"+returnedData.link_to_audio;
//       if(returnedData.verse == t_ver){
//         is_ended = true;
//       }
//       //$("#audio_source").attr('src', link);  

//       // document.getElementById('audio_source').setAttribute('src', link);

//       $('#cmbFVerse').val(returnedData.verse);
//       $('#c-verse').html(returnedData.description);
//       if(limit_verse==returnedData.verse)
//       {
//         equal_check=true;
//       }
//       var audio = $('#myAudio').get(0);

//       $("#arabic"+returnedData.verse).css("background-color",$('#cmbBColor').val());
//       $("#trans"+returnedData.verse).css("background-color",$('#cmbBColor').val());
//       $("#audio_source").prop('src', link);
//       audio.load();
//       audio.play();
//       if(repeat_num >1)
//       {
//        var count = 2;
//        audio.onended = function() {
//         if(count <= repeat_num){
//           count++;
//           this.play();
//         }
//         else
//         {
//           audio_player();
//         }
//       };
//     }else{

//     }
//     }

// }
// });

};


// Functions
var state="pause";
var one_time=true;
function playPause(){
  var x = document.getElementById("myAudio");
  var playbtn = document.getElementById("play_btn");

  if(one_time )
  {
   audio_player();
   one_time=false;
 }
 if(state=="pause")
 {    
   x.play(); 
   state="play";
   playbtn.className = "playing";
 } 
 else 
 {
   x.pause();
   state="pause";
   playbtn.className = "paused";
 } 
}

function stop_player(cond) {

  var audio = $('#myAudio').get(0);
  $("#audio_source").prop('src', "https://raw.githubusercontent.com/anars/blank-audio/master/250-milliseconds-of-silence.mp3");
  audio.load();
  audio.play();
  var savePlayer = $('#payer_area').html(); // Save player code
  $('#myAudio').remove(); // Remove player from DOM
  $('#payer_area').html(savePlayer); // Restore it
  $('#cmbFVerse').val(1).change();
  $('#cmbTVerse').val({{$surah->verses}}).change();
}
function assign_temp() {
 var audio = $('#myAudio').get(0);
 $("#audio_source").prop('src', "https://raw.githubusercontent.com/anars/blank-audio/master/250-milliseconds-of-silence.mp3");
 audio.load();
 audio.play();
 state="playing";
 playPause();
 var savePlayer = $('#payer_area').html(); // Save player code
 $('#myAudio').remove(); // Remove player from DOM
 $('#payer_area').html(savePlayer); // Restore it

 if(is_ended){
   $('#cmbFVerse').val(st_ver);
   equal_check = false;
   next_play=false;
   $("#arabic"+t_ver).css("background-color", "white");
   $("#trans"+t_ver).css("background-color", "white");
   is_ended = false;
 }
}
//repeat audio
//  $('#cmbRangeRepeat').change(reapeater);
//  function reapeater() {
  //   audio_player('repeat');
  // }
 
   var menuOpened = false;
   
  var navOpen = false;
  function myFunction() {
   
  //  var x = document.getElementById("myTopnav");
  //   if (x.className === "topnav") {
  //     x.className += " responsive";
  //     menuOpened = true;
  //   }
      
  //   else {
  //     x.className = "topnav";
  //     menuOpened = false;
  //   }  
  if(!navOpen) {
    document.querySelector('#logo + .inner-tabs').style.height = '290px';
    document.querySelector('.topnav').classList.add ('responsive');
    navOpen = true;
  }
  else {
    document.querySelector('#logo + .inner-tabs').style.height = '0';
    document.querySelector('.topnav').classList.remove ('responsive');

    navOpen = false;
  }
 }

 //get juz 

 $('#cmbJuz').change(getJuz);
 function getJuz()
 {
  var juz_number=$('#cmbJuz').val();
  $.ajax({
   url:'{{ url('/get-juzz') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "juz_number" : juz_number,
   },
   beforeSend: function(){
    document.getElementById("wait").style.display = "block";
  },
  complete: function(){
  },
  success: function (response) 
  {
   document.getElementById("wait").style.display = "none";
   if(response!=0)
   {
     var arabic='';
     var translation='';
     var from_verse='';
     var to_verse='';
     var returnedData = JSON.parse(response);
     var i=1;

     //update from verse option 
     var i;
     for (i = 1; i <= returnedData.verses; i++) { 
       from_verse=from_verse+'<option value="'+i+'">'+i+'</option>';
     }
     //update to verse option 
     returnedData.verse.forEach( function (item) {
      arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+"</span> <img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'> <span style='padding: 5px;'>"+item.verse+"</span> ";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+"</span> <img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span> ";
      i++;
    });
     //assign 1st audio 

     var link = "{{$ADMIN_ASSETS}}/audios/"+returnedData.link_to_audio;

     $('#cmbSura').val(returnedData.id);
     $("#arabic").html("");
     $("#arabic").append(arabic);
     $("#translation").html("");
     $("#translation").append(translation); 
     $("#cmbFVerse").html("");
     $("#cmbFVerse").append(from_verse); 
     $("#cmbTVerse").html("");
     $("#cmbTVerse").append(from_verse); 

   }
   else
   {
    // alert(response);
  }

}
});

}
function emptyObject(obj) {
  Object.keys(obj).forEach(k => delete obj[k])
}
//surah js 
$('#cmbSura').change(getSurah);
function getSurah(get_special){
  next_play=false;
  equal_check=false;
  assign_temp();
  emptyObject(c_obj);
  var surah_id=$('#cmbSura').val();
  if(get_special=='pre')
  {
    type = 'pre';
  }
  else if(get_special=='next')
  {
    type = 'next';
  }else{
    type = 'null';
  }
  // alert(surah_id);
  $.ajax({
   url:'{{ url('/get-surah') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "get_special" : type
   },
   beforeSend: function(){
    document.getElementById("wait").style.display = "block";
  },
  complete: function(){

  },
  success: function (response) 
  {
    document.getElementById("wait").style.display = "none";
    if(response!=0)
    {

     var returnedData = JSON.parse(response);
     st_ver = 1;
     t_ver = returnedData.verses;
     var arabic='';
     var translation='';
     var from_verse=st_ver;
     var to_verse= t_ver;
     var i=1;
     //update from verse option 
     var i;
     var link='';
     for (i = 1; i <= returnedData.verses; i++) { 
       from_verse=from_verse+'<option value="'+i+'">'+i+'</option>';

     }
     for (i = returnedData.verses; i >= 1; i--) { 
       to_verse=to_verse+'<option value="'+i+'">'+i+'</option>';

     }
     //update to verse option 
     $('#sura_n').html(returnedData.surah_name_arabic);
     $('#sura_nm').html(returnedData.surah_name);

     $('#c-surah').html(returnedData.introduction);
     returnedData.verse.forEach( function (item) {
      c_obj['verse_id' + item.verse] = item.verse;
      c_obj['arb_link' + item.verse] = item.link_to_audio;
      c_obj['arb_desc' + item.verse] = item.description;
      arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+"</span><img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span> ";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+"</span> <img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span> ";


    });
     console.log(c_obj);



     $('#cmbSura').val(returnedData.id);
     $("#arabic").html("");
     $("#arabic").append(arabic);
     $("#translation").html("");
     $("#translation").append(translation); 
     $("#cmbFVerse").html("");
     $("#cmbFVerse").append(from_verse); 
     $("#cmbTVerse").html("");
     $("#cmbTVerse").append(to_verse); 

     $("#cmbJuz").val(returnedData.juz_id);


   }
   else
   {
   }

   // $("#arabic").append(view);
   // 
 }
});

}
function previousSurah(){
  getSurah('pre');
}
function nextSurah(){
  getSurah('next');
}
//end surah js
//from verse change js
$('#cmbFVerse').change(getSurahFromVerse);
function getSurahFromVerse(){
  next_play=false;
  equal_check=false;
  assign_temp();
  var surah_id=$('#cmbSura').val();
  var from_verse=$('#cmbFVerse').val();
  var to_verse=$('#cmbTVerse').val();
  $.ajax({
   url:'{{ url('/get-surah-from-verse') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "from_verse" : from_verse,
     "to_verse" : to_verse,
   },
   beforeSend: function(){
     document.getElementById("wait").style.display = "block"; 
   },
   complete: function(){

   },
   success: function (response) 
   {
    document.getElementById("wait").style.display = "none";
    if(response!=0)
    {
     var arabic='';
     var translation='';
     var returnedData = JSON.parse(response);
     var i=1;
     var link='';
     returnedData.verse.forEach( function (item) {
      arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+"</span> <img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span> ";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+"</span> <img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span>";
      if(i==1)
      {
       link = "{{$ADMIN_ASSETS}}/audios/"+item.link_to_audio;
       st_ver = item.verse; 
      }
     i++;
   });

   }

   $("audio #audio_source").attr('src',"'"+link+"'");   
   $("#arabic").html("");
   $("#arabic").append(arabic);
   $("#translation").html("");
   $("#translation").append(translation);
   // $("#arabic").append(view);
   // 
 }
});
}

//end from verse js
//to verse change js
$('#cmbTVerse').change(getSurahToVerse);
function getSurahToVerse(){
  next_play=false;
  equal_check=false;
  assign_temp();
  var surah_id=$('#cmbSura').val();
  var from_verse=$('#cmbFVerse').val();
  var to_verse=$('#cmbTVerse').val();
  $.ajax({
   url:'{{ url('/get-surah-to-verse') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "from_verse" : from_verse,
     "to_verse" : to_verse,
   },
   beforeSend: function(){
     document.getElementById("wait").style.display = "block"; 
   },
   complete: function(){

   },
   success: function (response) 
   {
    document.getElementById("wait").style.display = "none";
    if(response!=0)
    {
     var arabic='';
     var translation='';
     var returnedData = JSON.parse(response);
     var i=1;
     t_ver = to_verse;

     returnedData.verse.forEach( function (item) {
      arabic=arabic+"<span class='arbic' id='arabic"+item.verse+"'>"+item.arabic_immune+"</span> <img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span> ";
      translation=translation+"<span class='trns' id='trans"+item.verse+"'>"+item.translation+" </span><img src='{{$PUBLIC_ASSETS}}/img/ayah-end.png' class='ayah-end'><span style='padding: 5px;'>"+item.verse+"</span> ";
      if(i==1)
      {
       link = "{{$ADMIN_ASSETS}}/audios/"+item.link_to_audio;

     }
     i++;
   });

   }
   //$("audio #audio_source").attr('src',"'"+link+"'");   
   $("#arabic").html("");
   $("#arabic").append(arabic);
   $("#translation").html("");
   $("#translation").append(translation);
   // $("#arabic").append(view);
   // 
 }
});
}

//end from verse js

//zoomin
var zoom_size=25;
var cust_num_size = 1;
function zoomin() {
  if(zoom_size<45)
  {
    zoom_size=zoom_size+5;
    var zoom=zoom_size+"px";
    $(".arbic").css("font-size", zoom);
    z=zoom_size-4;
    var zm=z+"px";
    $(".trns").css("font-size", zm);
    $(".trns").css("line-height","1.6");
    $(".arbic").css("line-height", "1.6"); 
    cust_num_size = cust_num_size + 0.1;
    $('.custom-number').css("font-size", cust_num_size+'rem');

  }
}
function zoomout() {
  if(zoom_size<=45 && zoom_size>25)
  {
    zoom_size=zoom_size-5;
    var zoom=zoom_size+"px";
    $(".arbic").css("font-size", zoom);
    z=zoom_size-5;
    var zm=z+"px";
    $(".trns").css("font-size", zm);
    $(".trns").css("line-height","1.5");
    $(".arbic").css("line-height", "1.5"); 
    cust_num_size = cust_num_size - 0.1;
    $('.custom-number').css("font-size", cust_num_size+'rem');
  }

}
//change fore color
$('#cmbFColor').change(fore_color_change);
function fore_color_change() {
  var color_code=$('#cmbFColor').val();
  $("#arabic").css("color",color_code);
  $("#translation").css("color",color_code);
  $("#fore-color").css("color",color_code);
}


//seach page content js
$('#searchBtn').click(function(){
 var search_text=$('#txtSearchText').val();
 var surah_id=$('#cmbSearchSura').val();
 var search_lang=$('#cmbSearchLanguage').val();
 var immn=$('#immn').val();
 
 $.ajax({
   url:'{{ url('/get-search') }}',
   type: 'post',
   data: {
     "_token": "{{ csrf_token() }}",
     "surah_id" : surah_id,
     "search_text" : search_text,
     "search_lang" : search_lang,
     "immn" : immn
   },
   beforeSend: function(){
     document.getElementById("wait").style.display = "block"; 
   },
   complete: function(){

   },
   success: function (response) 
   {
     document.getElementById("wait").style.display = "none"; 
     //  var returnedData = JSON.parse(response);

     var results='';
     var total_found=0;
     response.forEach( function (item) {
      total_found++;
      if(search_lang=='1')
      {

        results=results+'<a href="#" onclick="show_verse('+item.surah.surah_number+','+item.verse+')"> <h6>Sura '+item.surah.surah_number+' - '+item.surah.surah_name+' : Verse '+item.verse+'</h6></a><p class="arbic">'+item.arabic_immune+'</p>';

      }
      else
      {
       results=results+'<a href="#" onclick="show_verse('+item.surah.surah_number+','+item.verse+')"> <h6>Sura '+item.surah.surah_number+' - '+item.surah.surah_name+' : Verse '+item.verse+'</h6></a><p>'+item.translation+'</p>';

     }

   });
     $("#results").html("");
     $("#results").append(results);
     $("#total_found").html("");
     $("#total_found").append("Total Search Count : "+total_found);
   }
 });
});
function show_verse(surah_id,verse){
 change_content("home"); 
 //alert(surah_id);
 //$('#cmbSura').val(surah_id);
 //$('#cmbSura').val($('option:selected', this).data(surah_id));
 $("#cmbSura option[text=" + surah_id +"]").attr("selected","selected");
 $('#cmbTVerse').val(verse);
 $('#cmbFVerse').val(verse).change(); 
}
function show_verse_bookmark(surah_id,from_verse,to_verse){
 change_content("home"); 
 //alert(surah_id);
 //$('#cmbSura').val(surah_id);
 //$('#cmbSura').val($('option:selected', this).data(surah_id));
 $("#cmbSura option[text=" + surah_id +"]").attr("selected","selected");
 $('#cmbTVerse').val(to_verse);
 $('#cmbFVerse').val(from_verse).change(); 
}


function pause_page_switch_audio() {
 var x = document.getElementById("myAudio");
 var playbtn = document.getElementById("play_btn");
 x.pause();
 state="pause"
 playbtn.className = "paused";
}
function change_content(page) {

  if(page=="home")
  {
    document.getElementById("search_menu").style.display = "none";
    document.getElementById("search_content").style.display = "none";
    document.getElementById("home_menu").style.display = "block";
    document.getElementById("bookmark_content").style.display = "none";
    document.getElementById("inv_friend_content").style.display = "none";
    document.getElementById("bug_report").style.display = "none";
    document.getElementById("home_content").style.display = "block";
  }
  else if (page=="search")
  {
    pause_page_switch_audio();
    document.getElementById("home_menu").style.display = "none";
    document.getElementById("home_content").style.display = "none";
    document.getElementById("bookmark_content").style.display = "none";
    document.getElementById("inv_friend_content").style.display = "none";
    document.getElementById("bug_report").style.display = "none";
    document.getElementById("search_menu").style.display = "block";
    document.getElementById("search_content").style.display = "block";
  }
  else if (page=="inv_friend")
  {
   pause_page_switch_audio();
   document.getElementById("home_menu").style.display = "none";
   document.getElementById("home_content").style.display = "none";
   document.getElementById("search_menu").style.display = "none";
   document.getElementById("search_content").style.display = "none";
   document.getElementById("bookmark_content").style.display = "none";
   document.getElementById("bug_report").style.display = "none";  
   document.getElementById("inv_friend_content").style.display = "block";
 }
 else if (page=="bug_report")
 {
  pause_page_switch_audio();
  form_set();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("bookmark_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "block";  
}
else if (page=="bookmark")
{
  pause_page_switch_audio();
  document.getElementById("home_menu").style.display = "none";
  document.getElementById("home_content").style.display = "none";
  document.getElementById("search_menu").style.display = "none";
  document.getElementById("search_content").style.display = "none";
  document.getElementById("inv_friend_content").style.display = "none";
  document.getElementById("bug_report").style.display = "none";
  document.getElementById("bookmark_content").style.display = "block";
}
else 
{

}

}
function form_set() {
  $('#Surah_b_id').html("<b>Suarh : </b>"+$("#cmbSura option:selected").text());
  var verse_text="<b>Verse : </b>"+$('#cmbFVerse').val()+' - '+$('#cmbTVerse').val();
  $('#verse_b_id').html(verse_text);
  $('#recitor_b_id').html("<b>Recitor : </b>"+$("#cmbReciter option:selected").text());
  $('#Surah_b_id_in').val($("#cmbSura").val());
  $('#from_verse_b_id_in').val($('#cmbFVerse').val());
  $('#to_verse_b_id_in').val( $('#cmbTVerse').val());
  $('#recitor_b_id_in').val($('#cmbReciter').val());
}
//send invitarion
$(function () {
 $('#form').on('submit',function (e) {
   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/send_invitation') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {
                  if(response==1)
                  {
                    $('#invite_results').html('Invitation is successfully sent.');
                  }
                  else
                  {
                    $('#invite_results').html('Some thing went wrong.');
                  }
                  
                }
              });
      });
});


//save bookmarks
function save_bookmarks() {
  swal({
    type: "info",
    title: 'Save BookMark',
    text: '<div class="control-group"><input type="email" id="email_bookmark" class="form-control" placeholder="Enter your email" name="email" required></div><input type="hidden" value=" name="ticket_id"><div class="control-group"><br/><input type="reset" value="Cancel" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="submit" onclick="submit()" value="Save" class="btn btn-success"></div>',
    html: true,
    showConfirmButton: false ,

  });
}

function submit() {

 var email = $('#email_bookmark').val();
 if(email=='')
 {
  swal({
    type: "error",
    title: 'Provide Your Email',
    text: 'Email is required to save bookmarks.',
    html: true,
    text: '<input type="reset" value="Cancel" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="button" onclick="save_bookmarks()" value="Try Again" class="btn btn-success"></div>',
    showConfirmButton: false ,

  });

}
else
{
 var surah_id = $('#cmbSura').val();
 var from_verse = $('#cmbFVerse').val();
 var to_verse = $('#cmbTVerse').val();
       //here check the file attachment 
       console.log(email);
       console.log(surah_id);console.log(from_verse);console.log(to_verse);
       $.ajax({
         url: "{{ url('/save_bookmarks') }}",
         type: 'post',
         data: {
          "_token": "{{ csrf_token() }}",
          "email" : email,
          "surah_id" : surah_id,
          "from_verse" : from_verse,
          "to_verse" : to_verse,
        },
              // No need to process data.
              beforeSend: function(){
               document.getElementById('wait').style.display = "block";
             },
             complete: function(){
               document.getElementById('wait').style.display = "none";
             },
             success: function (response) 
             {
              if(response==1)
              {
                $('#results_bookmarks').html('Bookmark is saved.');
                swal({
                  type: "success",
                  title: 'Bookmark is saved',
                  html: true,
                  text: '<input type="button" value="Close" onclick="swal.close()" class="btn btn-success">',
                  showConfirmButton: false ,

                });
              }
              else if(response==2)
              {
                swal({
                  type: "error",
                  title: 'Bookmark is already saved',
                  html: true,
                  text: '<input type="button" value="Close" onclick="swal.close()" class="btn btn-success">',
                  showConfirmButton: false ,

                });
              }
              else
              {
                swal({
                  type: "error",
                  title: 'Something went wrong.',
                  html: true,
                  text: '<input type="reset" value="Cancel" onclick="swal.close()" class="btn btn-danger">&nbsp;&nbsp;&nbsp;<input type="button" onclick="save_bookmarks()" value="Try Again" class="btn btn-success"></div>',
                  showConfirmButton: false ,

                });
              }

            }
          });
     }
   }
//get book marks
$(function () {
 $('#get_bookmarks').on('submit',function (e) {
   e.preventDefault();
        //here check the file attachment 
        $.ajax({
         url: "{{ url('/get_bookmarks') }}",
         type: 'post',
         data: new FormData(this),
         contentType: false,       
         cache: false,            
                 processData:false,             // No need to process data.
                 beforeSend: function(){
                   document.getElementById('wait').style.display = "block";
                 },
                 complete: function(){
                   document.getElementById('wait').style.display = "none";
                 },
                 success: function (response) 
                 {document.getElementById('wait').style.display = "none";
                 if(response!=0 && response!=2)
                 {
                  var results='';
                  var total_found=0;
                  var returnedData = JSON.parse(response);
                  returnedData.forEach( function (item) {
                    total_found++;

                    results=results+'<a href="#" onclick="show_verse_bookmark('+item.surah_id+','+item.from_verse+','+item.to_verse+')"> <h6>Sura '+item.surah_id+',From Verse '+item.from_verse+', To Verse'+item.to_verse+'</h6></a><p></p>';
                  });
                  $("#results_bookmarks").html("");
                  $("#results_bookmarks").append(results);
                  $("#total_found_bookmarks").html("");
                  $("#total_found_bookmarks").append("Total Search Count : "+total_found);

                }
                else
                {
                  $('#results_bookmarks').html('Some thing went wrong.');
                }

              }
            });
      });
});



</script>
@endpush