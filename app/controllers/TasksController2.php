 function update($id)
        {
                        $task = Task::find(Input::get('task'));
                        $user = User::find(Auth::id());

                        if ($task->state == 'complete') {
                                $task->state = 'incomplete';
                                $task->save();

                                $user->tasks_completed = $user->tasks_completed - 1;
                                $user->save();
                        }else{
                                $task->state = 'complete';
                                $task->save();

                                $user->tasks_completed = $user->tasks_completed + 1;
                                $user->save();
                        }

                        return Redirect::back();
        }

        /**
         * Remove the specified resource from storage.
         * DELETE /tasks/{id}
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
        {
                $task = Task::find(Input::get('id'));
                $task->delete();

                return Redirect::back();
        }


