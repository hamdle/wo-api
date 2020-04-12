<?php
namespace Controllers;

use Http\Response;
use Database\Query\Users;
use Database\Query\Workouts;
use Database\Query\Reps;
use Database\Query\Sessions;
use Database\Query\Entries;

class WorkoutController implements ControllerInterface
{
    public function get($args = [])
    {
        $users = new Users();
        $user = $users->get(1);

        $workouts = new Workouts();
        $workout = $workouts->new(1);

        $data = [
            'user' => $user->email,
            'workout_html' => $workout->html()
        ];

        $response = new Response();
        return $response->send(Response::HTTP_200_OK, $data);
    }

    public function post($args = [])
    {
        $sessions = new Sessions();
        $data_args = $args['data'];
        
        if ($sessions->verify() == true) {
            $workouts = new Workouts();
            // Save workout to database.
            // TODO: Add user_id.
            $workouts->add($workouts->filter_args($data_args));

            $entries = new Entries();
            $reps = new Reps();

            $entries_args = $data_args['entries'];
            for ($index = 0; $index < count($entries_args); $index++) {
                // Save entries to database.
                // TODO: Add user_id.
                // TODO: Add workout_id.
                $entries->add($entries->filter_args($entries_args[$index]));

                $reps_args = $entries_args[$index]['reps'];
                foreach ($reps_args as $rep) {
                    // Save reps to database.
                    // TODO: Add entries_id.
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