<script>
$(document).ready(function() {

    let fabricPrice = 0;

    $('.search-fabric').each(function() {

        const $wrapper = $(this);
        const ajaxUrl = $wrapper.data('url');
        const inputId = $wrapper.data('input-id');
        const resultId = $wrapper.data('result-id');
        const fieldName = $wrapper.data('field-name');
        const targetId = $wrapper.data('target-id');

        let currentIndex = -1;

        const $input = $('#' + inputId);
        const $result = $('#' + resultId);

        function showLoading() {
            $result.removeClass('d-none')
                .html('<li class="search-item color loading fs14">در حال جستجو...</li>')
                .show();
        }

        function calcFabricTotal() {
            let meter = parseFloat($('#fabric_meter').val()) || 0;
            let total = meter * fabricPrice;
            $('#fabric_total_price').val(total);
        }

        function getCleanText(el) {
            return el.clone().children().remove().end().text().replace(/\s+/g, ' ').trim();
        }

        function navigateOptions(e) {
            const items = $result.find('li').not('.no-select');

            if (e.key === "ArrowDown") {
                if (currentIndex < items.length - 1) currentIndex++;
            } else if (e.key === "ArrowUp") {
                if (currentIndex > 0) currentIndex--;
            } else if (e.key === "Enter") {
                if (currentIndex > -1) {

                    const selectedItem = items.eq(currentIndex);

                    const value = getCleanText(selectedItem);
                    const id = selectedItem.data('id');

                    fabricPrice = selectedItem.data('price') || 0;

                    $input.val(value);

                    if (targetId) {
                        $('#' + targetId).val(id).trigger('change');
                    }

                    calcFabricTotal();

                    $result.hide();
                }
            }

            items.removeClass('selected');
            if (currentIndex >= 0) items.eq(currentIndex).addClass('selected');
        }

        $input.on('keydown', function(e) {
            if (["ArrowDown", "ArrowUp", "Enter"].includes(e.key)) {
                e.preventDefault();
                navigateOptions(e);
            }
        });

        $input.on('input', function() {
            if (targetId) $('#' + targetId).val('');
            fabricPrice = 0;
            calcFabricTotal();
        });

        $input.on('keyup', function(e) {

            let query = $(this).val().trim();

            if (["ArrowDown", "ArrowUp", "Enter"].includes(e.key)) return;

            if (query.length > 0) {

                showLoading();

                $.ajax({
                    url: ajaxUrl,
                    method: 'POST',
                    data: {
                        [fieldName]: query
                    },
                    dataType: 'json',

                    success: function(response) {

                        let output = '';

                        if (response.status === 'success' && response.items.length > 0) {

                            response.items.forEach(item => {

                                let cat = item.category ? ` - ${item.category}` : '';

                                output += `<li 
                                    class="resSel search-item color"
                                    data-id="${item.id}"
                                    data-price="${item.sell_price}"
                                    data-qty="${item.quantity}">
                                    ${item.name}${cat}
                                </li>`;
                            });

                        } else {
                            output = '<li class="search-item color no-select">چیزی یافت نشد</li>';
                        }

                        $result.html(output).show();
                        currentIndex = -1;
                    },

                    error: function() {
                        $result.html('<li class="search-item color no-select">خطا در جستجو</li>').show();
                    }
                });

            } else {
                $result.addClass('d-none').hide();
            }
        });

        $result.on('click', 'li', function() {

            if ($(this).hasClass('no-select')) return;

            const value = getCleanText($(this));
            const id = $(this).data('id');

            fabricPrice = $(this).data('price') || 0;

            $input.val(value);

            if (targetId) {
                $('#' + targetId).val(id).trigger('change');
            }

            calcFabricTotal();

            $result.hide();
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest($wrapper).length) {
                $result.hide();
            }
        });

        $input.on('focus', function() {
            if ($(this).val().length > 0) {
                $result.show();
            }
        });

        $('#fabric_meter').on('input', calcFabricTotal);

    });

});
</script>