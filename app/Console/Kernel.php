protected function schedule(Schedule $schedule)
{
    $schedule->command('crops:update-health')->daily();
}