<?php
namespace App\Logging;

use Monolog\LogRecord;
use Illuminate\Support\Facades\DB;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class DatabaseLogger extends AbstractProcessingHandler
{
    protected $table;
    protected $connection;

    public function __construct($level)
    {
        parent::__construct($level);
        $this->table = 'logs_' . date('Y_m_d');
        $this->connection = 'mysql';
    }

    protected function write(LogRecord $record): void
    {
        if (!DB::connection($this->connection)->getSchemaBuilder()->hasTable($this->table)) {
            DB::connection($this->connection)->getSchemaBuilder()->create($this->table, function ($table) {
                $table->increments('id');
                $table->string('channel');
                $table->text('message');
                $table->json('context');
                $table->json('extra');
                $table->dateTime('created_at');
            });
        }

        DB::connection($this->connection)->table($this->table)->insert([
            'channel' => $record->channel,
            'message' => $record->message,
            'context' => $record->context['exception']?json_encode($record->context['exception']->getTrace()):'{}',
            'extra' => json_encode($record->extra),
            'created_at' => $record->datetime->format('Y-m-d H:i:s'),
        ]);
    }

}
