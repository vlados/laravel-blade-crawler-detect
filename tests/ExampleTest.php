<?php

use Illuminate\Support\Facades\Blade;

it('if directive is compiled', function () {
    $bladeSnippet = '@user test @enduser';
    $expectedCode = '<?php if (\Illuminate\Support\Facades\Blade::check(\'user\')): ?> test <?php endif; ?>';
    $this->assertEquals($expectedCode, Blade::compileString($bladeSnippet));
});
