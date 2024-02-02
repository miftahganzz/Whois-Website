<?php
$whois_text = '';
$containerStyle = 'container mx-auto max-w-6xl p-6 mt-4 rounded-lg shadow-lg';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $domain = $_POST["domain"];
    $api_key = "your_apikey"; //Get Apikey From https://api.miftah.xyz
    $api_url = "https://api.miftah.xyz/api/tools/whois?api_key=$api_key&domain=" . urlencode($domain);

    $response = file_get_contents($api_url);

    $result = json_decode($response);

    if ($result && isset($result->data)) {
        $whois_text = json_encode($result->data, JSON_PRETTY_PRINT);
    } else {
        $whois_text = "Tidak dapat mengambil data WHOIS.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whois Lookup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        .container {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container-bg {
            background: rgba(255, 255, 255, 0.1);
        }
        .result-container {
            overflow-x: auto;
        }
        .content {
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-800 text-white">
    <div class="content flex flex-col justify-between">
        <div>
            <h1 class="text-5xl font-semibold mb-4 mt-4 text-center">WHOIS Lookup</h1>
            <div class="container mx-auto max-w-6xl p-3 mt-8 rounded-lg shadow-lg">
                <form method="post">
                    <div class="mb-4 flex items-center">
                        <input type="text" name="domain" id="domain" placeholder="Example: api.miftah.xyz, don't use https or http" class="input-bg bg-gray-700 text-white border rounded-l-lg w-4/5 p-1 text-lg transition duration-300" required>
                        <button type="submit" class="button-bg bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-1 rounded-r-lg text-lg flex items-center transition duration-300">
                            <i class="fas fa-search mr-2"></i> Lookup
                        </button>
                    </div>
                </form>
            </div>
            <?php if (!empty($whois_text)): ?>
            <div class="<?php echo $containerStyle; ?>">
                <?php if (!empty($domain)) : ?>
                <h2 class="text-3xl font-semibold mb-4 text-left">WHOIS Result for <?php echo $domain; ?></h2>
                <?php endif; ?>
                <div class="result-container">
                    <pre class="whitespace-pre-wrap"><?php echo $whois_text; ?></pre>
                </div>
                <div class="mt-4 flex space-x-4" id="button-container">
                    <button class="button-bg bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-1 rounded text-lg flex items-center transition duration-300" onclick="copyToClipboard()"><i class="fas fa-copy mr-2"></i>Copy</button>
                    <button class="button-bg bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-1 rounded text-lg flex items-center transition duration-300" onclick="shareResult()"><i class="fas fa-share mr-2"></i>Share</button>
                    <button class="button-bg bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-1 rounded text-lg flex items-center transition duration-300" onclick="deleteResult()"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <footer class="text-center text-gray-500 text-md mt-4">
            &copy; 2023 Miftah GanzZ | <a href="https://github.com/miftahganzz" class="text-blue-500" target="_blank">Github</a><p>Powered By: <a href="https://api-miftah.xyz" class="text-blue-500">Miftah Api</a></p>
        </footer>
    </div>
    <script src="function.js"></script>
</body>
</html>
