protected function schedule(Schedule $schedule)
{
    $schedule->command('crops:check-stages')->daily();
}