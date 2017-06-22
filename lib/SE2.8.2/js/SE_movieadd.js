/**
 * 
 * 동영상 소스 입력 textarea 수정. 
 * find and replace 참조. 
 */
nhn.husky.SE_Movieadd = jindo.$Class({
    name : "SE_Movieadd",

		$init : function(){},

		_assignHTMLElements : function(elAppContainer){

			this.oMovieButton = jindo.$$.getSingle("li.husky_seditor_ui_movie", elAppContainer);
			
			this.oMovieLayer = jindo.$$.getSingle("DIV.se2_layer", this.oMovieButton);

			this.oMovSource = jindo.$$.getSingle("TEXTAREA.se2_movie_source", this.oMovieLayer);
			
			this.oBtnConfirm = jindo.$$.getSingle("BUTTON.se2_movie_apply", this.oMovieLayer);
			this.oBtnCancel = jindo.$$.getSingle("BUTTON.se2_movie_cancel", this.oMovieLayer);
			this.oBtnClose = jindo.$$.getSingle("BUTTON.se2_movie_close", this.oMovieLayer);
		},

		$ON_MSG_APP_READY : function(){
			this.bLayerShown = false;

			this.oApp.exec("REGISTER_UI_EVENT", ["movie", "click", "TOGGLE_MOVIE_LAYER"]);
		// this.oApp.exec("REGISTER_HOTKEY", ["ctrl+k", "TOGGLE_HYPERLINK_LAYER", []]);
		// this.oApp.registerLazyMessage(["TOGGLE_HYPERLINK_LAYER", "APPLY_HYPERLINK"], ["hp_SE2M_Hyperlink$Lazy.js"]);
		},
		
		$LOCAL_BEFORE_FIRST : function(sMsg){
			this._assignHTMLElements(this.oApp.htOptions.elAppContainer);
			this.oApp.registerBrowserEvent(this.oBtnConfirm, "click", "APPLY_MOVIE");
			// this.oApp.registerBrowserEvent(this.oBtnConfirm, "click", "APPLY_MOVIE_OPEN_WINDOW");
			
			this.oApp.registerBrowserEvent(this.oBtnCancel, "click", "HIDE_ACTIVE_LAYER");
			this.oApp.registerBrowserEvent(this.oBtnClose, "click", "HIDE_ACTIVE_LAYER");
			
			this.oApp.registerBrowserEvent(this.oMovSource, "keydown", "EVENT_MOVIE_KEYDOWN");
		},

		$ON_TOGGLE_MOVIE_LAYER : function(){
			if(!this.bLayerShown){
				this.oApp.exec("IE_FOCUS", []);
				this.oSelection = this.oApp.getSelection();
			}

			// hotkey may close the layer right away so delay here
			this.oApp.delayedExec("TOGGLE_TOOLBAR_ACTIVE_LAYER", [this.oMovieLayer, null, "MSG_MOVIE_LAYER_SHOWN", [], "MSG_MOVIE_LAYER_HIDDEN", [""]], 0);
			//this.oApp.exec('MSG_NOTIFY_CLICKCR', ['movie']);
		},
	
		$ON_MSG_MOVIE_LAYER_SHOWN : function(){
			this.bLayerShown = true;
			this.oMovSource.value = "";
			this.bModify = false;

			this.oApp.delayedExec("SELECT_UI", ["movie"], 0);
			this.oMovSource.focus();
			
			this.oMovSource.value = this.oMovSource.value;
			this.oMovSource.select();
		},
		
		$ON_MSG_MOVIE_LAYER_HIDDEN : function(){
			this.bLayerShown = false;
			
			this.oApp.exec("DESELECT_UI", ["movie"]);
		},
		
		$ON_APPLY_MOVIE : function(){
			var sURL = this.oMovSource.value;
			// sURL = "./movie_play.php?url="+sURL;
			// sURL = "../bbs/movie/"+sURL;

			var oAgent = jindo.$Agent().navigator();
			var sBlank = "";

			this.oApp.exec("IE_FOCUS", []);
			
			if(oAgent.ie){sBlank = "<span style=\"text-decoration:none;\">&nbsp;</span>";}

			// iframe, embed resize
				sURL = sURL.replace(/width=["']\d*(?:|px|em)["']/, 'width="695"'); 
				sURL = sURL.replace(/height=["']\d*(?:|px|em)["']/, 'height="392"');

			var sBM;
			var str = sURL + sBlank;
			// var str = "<iframe src='"+sURL+"' frameborder='0' allowfullscreen></iframe>" + sBlank;
			// var str = "<embed src='" + sURL + "' type='application/x-shockwave-flash' x-allowscriptaccess='always' loop='true' autostart='true'>" + sBlank;

			this.oSelection.pasteHTML(str);
			//sBM = this.oSelection.placeStringBookmark();

			this.oApp.exec("HIDE_ACTIVE_LAYER");
		},
		/**
		 * 팝업창 오픈
		 */
		// $ON_APPLY_MOVIE_OPEN_WINDOW : function(){	
		// 	var sURL = this.oMovSource.value;

		// 	this.htPopupOption = {
		// 		oApp : this.oApp,
		// 		sName : this.name,
		// 		bScroll : false,
		// 		sProperties : "",
		// 		sUrl : ""
		// 	};
		// 	this.oPopupMgr = nhn.husky.PopUpManager.getInstance(this.oApp);
		// 	this.htPopupOption.sUrl = this.makePopupURL();
		// 	this.htPopupOption.sUrl += '?url='+sURL;
		// 	this.htPopupOption.sProperties = "left=0,top=0,width=403,height=359,scrollbars=yes,location=no,status=0,resizable=no";

		// 	this.oPopupWindow = this.oPopupMgr.openWindow(this.htPopupOption);
			
		// 	// 처음 로딩하고 IE에서 커서가 전혀 없는 경우
		// 	// 복수 업로드시에 순서가 바뀜
		// 	// [SMARTEDITORSUS-1698]
		// 	this.oApp.exec('FOCUS', [true]);
		// 	// --[SMARTEDITORSUS-1698]
		// 	return (!!this.oPopupWindow ? true : false);
		// },	
		/**
		 * URL생성
		 */	
		// makePopupURL : function(){
		// 	var sPopupUrl = "./movie_play.php";
			
		// 	return sPopupUrl;
		// },

		$ON_EVENT_MOVIE_KEYDOWN : function(oEvent){
			if (oEvent.key().enter){
				this.oApp.exec("APPLY_MOVIE");
				oEvent.stop();
			}
		}
});