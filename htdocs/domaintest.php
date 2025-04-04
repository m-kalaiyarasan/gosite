<?php
function isDomainPointedToServer($domain, $serverIp) {
    // Resolve the domain to its IP address
    $domainIp = gethostbyname($domain);


    $serverIp = "106.51.76.75";
    // Compare the resolved IP with the server's IP
    print($domainIp."<br>");
    print($serverIp);
    return $domainIp === $serverIp;
}

// Example usage
$domain = "kalaiyarasan.me";
$serverIp = "192.168.1.100"; // Replace with your server's IP address

if (isDomainPointedToServer($domain, $serverIp)) {
    echo "The domain is pointed to your server.";
} else {
    echo "The domain is not pointed to your server.";
}

function isValidDomain($domain) {
    // Regular expression for a valid domain name
    $pattern = '/^(?!\-)([a-zA-Z0-9\-]{1,63}(?<!\-)\.)+[a-zA-Z]{2,}$/';
    return preg_match($pattern, $domain) === 1;
}

// Example usage
$domain = "example.";

if (isValidDomain($domain)) {
    echo "Valid domain.";
} else {
    echo "Invalid domain.";
}
?>

