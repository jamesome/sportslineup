(function(context) {
	if (context.board_list) {
		return;
	}

	context.board_list = {
		/**
		 * 
		 */
		get_board_list: function() {

			$.post("/ajax/Ajax_news/get_board_list_ajax", {

				},
				function(data) {
					if (data) {
						$(".admin_rank_list tbody tr").detach();
						this.set_news_list(data);
					}
				}, 'json'
			);
		},

	};
})(window);
