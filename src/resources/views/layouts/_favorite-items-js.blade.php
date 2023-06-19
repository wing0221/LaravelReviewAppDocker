<script>
$(function ()
{
    $('.toggle_favorite').on('click', function ()
    {
        is_favorite = $(this).attr("is_favorite");
        item_id = $(this).attr("item_id");
        click_button = $(this);
        $.ajax({
            url: "favorite-items",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 
                    'is_favorite': is_favorite,
                    'item_id': item_id, 
                  },
                })
            //正常にコントローラーの処理が完了した場合
            .done(function (data) //コントローラーからのリターンされた値をdataとして指定
            {
                if ( data == 0 )
                {
                    click_button.attr("is_favorite", "1");
                    click_button.text('⭐️');
                }
                if ( data == 1 )
                {
                    click_button.attr("is_favorite", "0");
                    click_button.text('☆');
                }
                
            })
            ////正常に処理が完了しなかった場合
            .fail(function (data)
            {
                alert('お気に入り処理失敗');
            });
            click_button.disabled = false;
    });
});
</script>