(function(context) {
	if (context.board_view) {
		return;
	}

	context.board_view = {
		/**
		 * 뉴스 뷰 가져오기
		 */
		get_board_view: function() {

			$.post("/ajax/Ajax_news/get_board_view_ajax", {

				},
				function(data) {
					if (data) {
						$(".admin_rank_list tbody tr").detach();
						this.set_board_view(data);
					}
				}, 'json'
			);
		},

	};
})(window);
