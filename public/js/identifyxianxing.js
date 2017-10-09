  $(".btn").click(function() {

        $(this).siblings('.btn').removeClass('hover');  // 删除其他兄弟元素的样式

        $(this).addClass('hover');                            // 添加当前元素的样式

    });

