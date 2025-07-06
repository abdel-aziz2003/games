<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $content = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa. Lobortis mattis aliquam faucibus purus in massa. Ut placerat orci nulla pellentesque dignissim enim sit amet venenatis. Pellentesque sit amet porttitor eget dolor morbi non arcu risus. Semper auctor neque vitae tempus. Consectetur lorem donec massa sapien faucibus. Feugiat pretium nibh ipsum consequat nisl vel pretium. Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Volutpat blandit aliquam etiam erat velit scelerisque in. Amet porttitor eget dolor morbi non arcu risus. Justo nec ultrices dui sapien eget mi proin. Enim nunc faucibus a pellentesque sit amet. In cursus turpis massa tincidunt dui ut ornare lectus. Aliquam eleifend mi in nulla posuere sollicitudin aliquam. Maecenas volutpat blandit aliquam etiam erat velit scelerisque in dictum. Commodo elit at imperdiet dui. Fringilla phasellus faucibus scelerisque eleifend donec. Diam quam nulla porttitor massa. Vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. A cras semper auctor neque vitae tempus. Duis ut diam quam nulla porttitor massa. Volutpat sed cras ornare arcu dui vivamus arcu felis bibendum. Consectetur adipiscing elit ut aliquam. Diam vel quam elementum pulvinar etiam non quam. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque. Erat imperdiet sed euismod nisi porta lorem. Ornare massa eget egestas purus viverra accumsan. Ultricies mi quis hendrerit dolor magna eget est lorem ipsum. Blandit turpis cursus in hac habitasse.</p>";
        Page::insert([
            ['name' => 'Privacy Policy', 'content' => $content],
            ['name' => 'Terms of Use', 'content' => $content],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
