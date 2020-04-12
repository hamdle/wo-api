<?php
namespace Controllers;

use Http\Response;
use Database\Query\Workouts;
use Database\Query\Reps;
use Database\Query\Sessions;
use Database\Query\Entries;

class WorkoutController implements ControllerInterface
{
    public function get($args = [])
    {
        // TODO
    }

    public function post($args = [])
    {
        $sessions = new Sessions();
        $data_args = $args['data'];

        $user = $sessions->verify(); 
        if ($user) {
            $workouts = new Workouts();
            $entries = new Entries();
            $reps = new Reps();

            // Save workout to database.
            $data_args['user_id'] = $user->id;
            $data_args['start'] = \Utils\Date::timestampToDatetime($data_args['start']);
            $data_args['end'] = \Utils\Date::timestampToDatetime($data_args['end']);
            // TODO: Filter 'feel' properly.
            $data_args['feel'] = 'average';
            $workout_id = $workouts->add($workouts->filter_args($data_args));

            $entries_args = $data_args['entries'];

            for ($index = 0; $index < count($entries_args); $index++) {
                // Save entries to database.
                $entries_args[$index]['user_id'] = $user->id;
                $entries_args[$index]['workout_id'] = $workout_id;
                // TODO: Filter '' properly.
                $entries_args[$index]['feedback'] = 'none';
                $entries_id = $entries->add($entries->filter_args($entries_args[$index]));

                $reps_args = $entries_args[$index]['reps'];
                foreach ($reps_args as $rep) {
                    // Save reps to database.
                    $rep['entries_id'] = $entries_id;
                    $reps->add($reps->filter_args($rep));
                }
            }

            $response = new Response();
            return $response->send(Response::HTTP_200_OK);
        }

        $response = new Response();
        return $response->send(Response::HTTP_401_UNAUTHORIZED);
    }

    public function put($args = [])
    {
        // TODO
    }

    public function patch($args = [])
    {
        // TODO
    }

    public function delete($args = [])
    {
        // TODO
    }
}
