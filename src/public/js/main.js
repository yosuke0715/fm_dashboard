$('[name = "achievement"]').on('change', function(){

    const target_BCC_id = $(this).val();
    const user_id = $('#user_id').val();
    const url =  user_id+'/'+target_BCC_id;
console.log(url);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "get",
        url: url,
        dataType: "json",

    })
        //通信が成功したとき
        .then((result) => {
            console.log('成功');
        })
        //通信が失敗したとき
        .fail((error) => {
            alert('エラーが発生しました。もう一度画面を読み込んでください。');
            console.log(error.statusText);
        });
})
