<?php

namespace SalesTaxes\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

class GoldenMasterTest extends TestCase
{
    public function testGoldenMaster()
    {
        global $argv;
        $scriptToRun = __DIR__ . '/../../bin/fixture.php';
        $argv = [$scriptToRun];

        ob_start();
        include $scriptToRun;
        $output = ob_get_clean();
        $this->assertGreaterThan(0, strlen($output), 'Seems like the run of golden master produced an empty output');

        $goldenMasterFile = __DIR__ . '/GOLDEN_MASTER';
        if (!file_exists($goldenMasterFile)) {
            file_put_contents($goldenMasterFile, $output);
        }

        $goldenMasterFileContent = file_get_contents($goldenMasterFile);
        $this->assertEquals($goldenMasterFileContent, $output);
    }
}
