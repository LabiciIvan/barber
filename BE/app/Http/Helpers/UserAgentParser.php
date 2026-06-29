<?php

namespace App\Http\Helpers;

class UserAgentParser
{
    private string $userAgent;

    public function __construct(string $userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public static function parse(string $userAgent): array
    {
        $parser = new self($userAgent);

        return [
            'device'   => $parser->getDevice(),
            'browser'  => $parser->getBrowser(),
            'os'       => $parser->getOS(),
        ];
    }

    public function getDevice(): array
    {
        $ua = $this->userAgent;
        $isMobile = (bool) preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $ua);

        $type  = $isMobile ? 'mobile' : 'desktop';
        $model = 'Unknown';

        $devicePatterns = [
            '/iPhone/'                           => 'iPhone',
            '/iPad/'                             => 'iPad',
            '/Pixel\s?([\w]+)/'                  => 'Google Pixel $1',
            '/Samsung\s?([\w\-]+)/'              => 'Samsung $1',
            '/HUAWEI\s?([\w\-]+)/'               => 'Huawei $1',
            '/OnePlus\s?([\w]+)/'                => 'OnePlus $1',
            '/Redmi\s?([\w]+)/'                  => 'Redmi $1',
            '/Mi\s?([\w]+)/'                     => 'Xiaomi Mi $1',
            '/Nexus\s?([\w]+)/'                  => 'Nexus $1',
        ];

        foreach ($devicePatterns as $pattern => $name) {
            if (preg_match($pattern, $ua, $m)) {
                $model = isset($m[1]) ? preg_replace('/\$1/', $m[1], $name) : $name;
                break;
            }
        }

        return [
            'type'  => $type,
            'model' => $model,
        ];
    }

    public function getBrowser(): array
    {
        $ua = $this->userAgent;

        // Order matters — Edge/Opera must come before Chrome/Safari
        $browsers = [
            'Edge'            => '/Edg\/([\d.]+)/',
            'Opera'           => '/OPR\/([\d.]+)/',
            'Chrome'          => '/Chrome\/([\d.]+)/',
            'Firefox'         => '/Firefox\/([\d.]+)/',
            'Safari'          => '/Version\/([\d.]+).*Safari/',
            'Samsung Browser' => '/SamsungBrowser\/([\d.]+)/',
            'Internet Explorer' => '/MSIE ([\d.]+)|Trident.*rv:([\d.]+)/',
        ];

        foreach ($browsers as $name => $pattern) {
            if (preg_match($pattern, $ua, $m)) {
                $version = $m[1] ?? $m[2] ?? 'Unknown';
                $parts   = explode('.', $version);

                return [
                    'name'          => $name,
                    'version'       => $version,
                    'major_version' => $parts[0] ?? 'Unknown',
                ];
            }
        }

        return [
            'name'          => 'Unknown',
            'version'       => 'Unknown',
            'major_version' => 'Unknown',
        ];
    }

    public function getOS(): array
    {
        $ua = $this->userAgent;

        $systems = [
            'iOS'     => '/iPhone OS ([\d_]+)|CPU OS ([\d_]+)/',
            'Android' => '/Android ([\d.]+)/',
            'Windows' => '/Windows NT ([\d.]+)/',
            'macOS'   => '/Mac OS X ([\d_]+)/',
            'Linux'   => '/Linux/',
        ];

        $windowsVersions = [
            '10.0' => '10/11',
            '6.3'  => '8.1',
            '6.2'  => '8',
            '6.1'  => '7',
        ];

        foreach ($systems as $name => $pattern) {
            if (preg_match($pattern, $ua, $m)) {
                $raw     = $m[1] ?? $m[2] ?? null;
                $version = $raw ? str_replace('_', '.', $raw) : 'Unknown';

                if ($name === 'Windows' && isset($windowsVersions[$version])) {
                    $version = $windowsVersions[$version];
                }

                return [
                    'name'    => $name,
                    'version' => $version,
                ];
            }
        }

        return [
            'name'    => 'Unknown',
            'version' => 'Unknown',
        ];
    }
}