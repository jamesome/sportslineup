Hol1000 에디터 수정 

1. 스마트 에디터 스킨 수정
스킨 복사 
/lib/SE2.8.2/SmartEditor2Skin.html
/lib/SE2.8.2/SmartEditor2Use.html

2. 사진 업로더 수정 
js.이동
/lib/SE2.8.2/sample/js/plugin/hp_SE2M_AttachQuickPhoto.js >>
/lib/SE2.8.2/js/hp_SE2M_AttachQuickPhoto.js

photo_uploader 폴더 이동
/lib/SE2.8.2/sample/photo_uploader
/lib/SE2.8.2/photo_uploader

/lib/SE2.8.2/photo_uploader/photo_uploader.html
/lib/SE2.8.2/photo_uploader/photo_uploader.php

3. 사진첨부 수정
/lib/SE2.8.2/SmartEditor2Use.html

<!-- 사진첨부샘플  --> 
<script type="text/javascript" src="./sample/js/plugin/hp_SE2M_AttachQuickPhoto.js" charset="utf-8"></script>

<script type="text/javascript" src="./js/hp_SE2M_AttachQuickPhoto.js" charset="utf-8"></script>

5. hp_SE2M_AttachQuickPhoto.js 수정

	makePopupURL : function(){
		var sPopupUrl = "./sample/photo_uploader/photo_uploader.html";

	makePopupURL : function(){
		var sPopupUrl = "./photo_uploader/photo_uploader.php";


6. file_uploader.php수정..
/lib/SE2.8.2/photo_uploader/file_uploader.php
/lib/SE2.8.2/photo_uploader/file_uploader_html5.php

 path ::  /data/photo/{Year}/{month}/
 filename :: get_file_path(updir, fname, is_trans_name = true)
is_trans_name :: md5(time().user_idx."_".md5(fname));


###############
7. 

				<li class="se2_mn husky_seditor_ui_movie"><button type="button" class="se2_movie ico_btn"><span class="se2_movicon"></span><span class="se2_mntxt">동영상<span class="se2_new"></span></span></button>
					<!-- 동영상 소스 -->
					<div class="se2_layer husky_seditor_movie_layer" style="margin-left:-338px;">
						<div class="se2_in_layer">
							<div class="se2_movie_source">
								<button type="button" title="닫기" class="se2_close se2_movie_cancel"><span>닫기</span></button>
								<h3>동영상 소스</h3>

								<div class="se2_in_bx_movie husky_se2m_find_ui" style="display:block">
									<dl><textarea class="se2_movie_source"></textarea></dd>
									</dl>
									<p class="se2_apply_btns">
										<button type="button" class="se2_apply se2_movie_apply"><span>적용</span></button><button type="button" class="se2_cancel se2_movie_cancel"><span>취소</span></button>
									</p>
								</div>
							</div>
						</div>
					</div>
					<!-- 동영상 소스 -->
					</li>



/lib/SE2.8.2/css/smart_editor2.css
#smart_editor2 .se2_text_tool button,#smart_editor2 .se2_multy .se2_icon{width:21px;height:21px;background:url("../img/ko_KR/text_tool_set_161117.png?161117") no-repeat;vertical-align:top}
>> 
#smart_editor2 .se2_text_tool button,#smart_editor2 .se2_multy .se2_icon, #smart_editor2 .se2_multy .se2_movicon{width:21px;height:21px;background:url("../img/ko_KR/text_tool_set_161117.png?161117") no-repeat;vertical-align:top}



#################################
### ex2 ##
7. 동영상 링크 수정. 
/lib/SE2.8.2/SmartEditor2Use.html 수정 
a. 동영상링크 스크립트 추가. 
-- /lib/SE2.8.2/js/SE_movieadd.js
<script type="text/javascript" src="./js/SE_movieadd.js" charset="utf-8"></script>

b. class="husky_seditor_ui_hyperlink" 다음에 아이콘 추가.  
-- line 276
				<li class="husky_seditor_ui_movie"><button type="button" title="동영상" class="se2_movie"><span class="_buttonRound">동영상</span></button>
					<!-- 링크 -->
					<div class="se2_layer" style="margin-left:-285px">
						<div class="se2_in_layer">
							<div class="se2_movie2">
								<input type="text" class="input_ty1" value="">
								<button type="button" class="se2_apply"><span>적용</span></button><button type="button" class="se2_cancel"><span>취소</span></button>
							</div>
						</div>
					</div>
					<!-- //링크 -->
				</li>
c. 설정 추가 
/lib/SE2.8.2/js/SE2M_Configuration.js

nhn.husky.SE2M_Configuration.SE_Movieadd = {
	bAutolink : false	// 자동링크기능 사용여부(기본값:true)
};

d. css 추가 
이미지 수정(아이콘 추가)
> /lib/SE2.8.2/img/ko_KR/text_tool_set.png
>> /lib/SE2.8.2/img/ko_KR/text_tool_set_161117.png

/lib/SE2.8.2/css/smart_editor2.css

#smart_editor2 .se2_text_tool .se2_movie { background-position: -513px -37px; }
#smart_editor2 .se2_text_tool .hover .se2_movie { background-position: -534px -37px; }
#smart_editor2 .se2_text_tool .active .se2_movie { background-position: -555px -37px; }


#smart_editor2 .se2_text_tool .se2_multy .se2_movicon{display:inline-block;visibility:visible;overflow:visible;position:static;width:16px;height:29px;margin:-1px 2px 0 -1px;background-position:-18px -132px;line-height:30px;vertical-align:top}

/lib/SE2.8.2/css/smart_editor2_items.css
/* TEXT_TOOLBAR : MOVIE - add 2016.11.17*/
#smart_editor2 .se2_movie_source {position:relative;width:355px;margin:0;padding:0}
#smart_editor2 .se2_movie_source .se2_close{position:absolute;top:5px;right:8px;width:20px;height:20px;background:url("../img/ko_KR/btn_set.png?130306") -151px -1px no-repeat}
#smart_editor2 .se2_movie_source h3{margin:0;padding:10px 0 13px 10px;background:url("../img/bg_find_h3.gif") 0 -1px repeat-x;font-size:12px;line-height:14px;letter-spacing:-1px}
#smart_editor2 .se2_movie_source .se2_in_bx_movie dl{_display:inline;float:left;width:340px;margin:0 0 0 5px;padding:5px 0;}

#smart_editor2 .se2_movie_source textarea{position:relative;top:5px;left:8px;width:322px;height:40px;margin:1px 0 0 0;padding:3px 2px 3px 4px;font-size:12px;color:#666;resize:none;}

#smart_editor2 .se2_movie_source .se2_apply_btns{float:left;clear:both;width:355px;padding:8px 0 10px 0;text-align:center;}
#smart_editor2 .se2_movie_source .se2_apply {width:41px; height:24px; margin: 0px 3px 1px 0; background: url("../img/ko_KR/btn_set.png?130306") no-repeat; }
#smart_editor2 .se2_movie_source .se2_cancel{width:39px; height:24px; background:url("../img/ko_KR/btn_set.png?130306") -41px 0 no-repeat;}


d. 환경설정 추가 
 /lib/SE2.8.2/js/SE2M_Configuration.js
nhn.husky.SE2M_Configuration.SE_Movieadd = {
	bAutolink : false	// 자동링크기능 사용여부(기본값:true)
};

e. 실행 구문 추가. 
/lib/SE2.8.2/js/SE2BasicCreator.js
oEditor.registerPlugin(new nhn.husky.SE_Movieadd(elAppContainer));			// 동영상 첨부



9. Editor 보안 필터링 수정
/lib/SE2.8.2/js/SE2BasicCreator.js
//보안 필터링 플러그인
			// _rxFilter:/<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*?>/gi,
			>> 
			// // embed, iframe 허용.
			_rxFilter:/<\/*(?:applet|b(?:ase|gsound|link)|frame(?:set)?|i(?:layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*?>/gi,
