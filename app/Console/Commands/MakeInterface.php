<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeInterface extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path().'/Contracts/'.$name.'.php';

        // Create the directory if it doesn't exist
        if (!file_exists(app_path().'/Contracts')) {
            mkdir(app_path().'/Contracts', 0777, true);
        }

        // Check if the interface file already exists
        if (file_exists($path)) {
            $this->error('Interface already exists!');
            return 0;  // Using return 0 to indicate error
        }

        // Interface content template
        $content = "<?php\n\nnamespace App\Contracts;\n\ninterface {$name}\n{\n    // Methods\n}\n";

        // Write the interface file
        file_put_contents($path, $content);

        // Output success message
        $this->info('Interface created successfully.');
    }
}
