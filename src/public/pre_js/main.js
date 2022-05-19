$(window).ready(function(){
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

    $('.BSS_edit_btn').on('click', function(){
       const BSS_id = $(this).val();
       location.href = '/admin/bss-edit/'+BSS_id;
       return false;
    });
    $('.BSS_del_btn').on('click', function(){
        const BSS_id = $(this).val();
        location.href = '/admin/bss-del/'+BSS_id;
        return false;
    });

    $('.sort_no').on('click', function(){
        location.href = '/bss_sort/no';
        return false;
    });

    $('.add_desc').on('click', function(){
        const target_url = $(this).val();
        location.href = '/bss-add-desc/'+target_url;

        return false;
    });
    $('.add_OK_flag').on('click', function (){
        const target_id = $(this).val();
        location.href = '/admin/bss-score/OK/'+target_id;
    });
    $('.add_NG_flag').on('click', function (){
        const target_id = $(this).val();
        location.href = '/admin/bss-score/NG/'+target_id;
    });
});

