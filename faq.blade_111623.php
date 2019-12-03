<div class="wra">
    <div class="header">
        <div class="header_section">
            <div class="header_subTitle_area">
                <div class="header_subTitleBox">
                     
                    <h1 class="header_subTitle">FAQ</h1>
                </div>
            </div>
        </div>
    </div>
    <form method="GET" action="/faq/faq">
    <input type="text" name="key" value="" placeholder="검색하기">

    </form>
    <div id="container" class="container">
        <div class="contants">
            <div class="setting_page" id="page">
                <div class="faq_section">
                    <div class="faq_category_area">
                        <div class="faq_category_box">
                            @foreach($faq_categorys as $i=>$category)
                             <a  class="faq_category @if($i == 0) active @endif" data-id = "{{$category['id']}}">{{$category['name_'.$lang]}}</a>
                            @endforeach
                             
                            <span class="last_20"></span>
                        </div>
                    </div>
                    @foreach($faq_categorys as $i=>$category)
                    <div class="faq_contents_area area_{{$category['id']}} @if($i == 0 ) active @endif">
                        @foreach($category['faqs'] as $faq)
                        <div class="faq_contants_itemBox">
                            <button type="button" class="faq_itemTitle">
                                <span class="faq_caption">Q.</span>
                                <h1 class="faq_title">{{$faq['question_'.$lang]}}</h1>
                                <img src="/assets/images/all/select_icon.png" width="15px">
                            </button>
                            <p class="faq_contants_text">{{$faq['answer_'.$lang]}}</p>
                        </div>
                        @endforeach
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div><!--//contants-->
    </div><!--//container-->
</div><!--//wra-->
<style>
    .faq_contents_area{
        display:none;
    }
    .faq_contents_area.active{
        display:block;
    }
    </style>
<script>
    $(".faq_category").click(function(){
        var id = $(this).data('id');
        $(".faq_category").removeClass('active');
        $(this).addClass('active');
        $('.faq_contents_area').removeClass('active');
        $('.faq_contents_area.area_'+id).addClass('active');

    });
    $(".faq_itemTitle").click(function(){
        $(this).siblings(".faq_contants_text").stop().slideToggle(300);
        $(this).parents(".faq_contants_itemBox").toggleClass("active");
    });
</script>