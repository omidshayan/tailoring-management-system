    <iframe id="print_frame" name="print_frame" style="display:none;"></iframe>

    <script>
        var printFrame = document.getElementById('print_frame');

        printFrame.src = '<?php echo $url; ?>';

        printFrame.onload = async function() {
            const frameWindow = printFrame.contentWindow;

            await frameWindow.document.fonts.ready;
            setTimeout(() => {
                frameWindow.focus();
                frameWindow.print();

            }, 100);
        };
    </script>