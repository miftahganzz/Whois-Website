
        function shareResult() {
            var title = "WHOIS Lookup Result";
            var url = window.location.href;
            var textToShare = "Title: " + title + "\nURL: " + url + "\nResult: " + <?php echo json_encode($whois_text); ?>;

            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: textToShare,
                    url: url,
                })
                .then(() => {
                    console.log("Sharing succeeded.");
                })
                .catch((error) => {
                    console.error("Sharing failed:", error);
                });
            } else {
                alert("Sharing not supported on this browser.");
            }
        }

        function copyToClipboard() {
            var textToCopy = document.querySelector(".result-container pre");
            var text = textToCopy.innerText;

            if (textToCopy) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Result copied to clipboard');
                    var copyButton = document.getElementById('copy-button');
                    if (copyButton) {
                        copyButton.innerText = 'Copied!';
                    }
                }).catch(function(error) {
                    alert('Copy failed: ' + error);
                });
            }
        }

        function deleteResult() {
            const resultContainer = document.querySelector('.result-container');
            const textHeader = document.querySelector('h2.text-3xl');
            const buttonContainer = document.querySelector('#button-container');
            const shadowContainer = document.querySelector('.container');
            if (resultContainer) {
                resultContainer.remove();
            }
            if (textHeader) {
                textHeader.remove();
            }
            if (buttonContainer) {
                buttonContainer.remove();
            }
            if (shadowContainer) {
                shadowContainer.style.boxShadow = 'none';
            }
        }
