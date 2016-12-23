ass ProjectsController extends \BaseController {

        /**
         * Display a listing of the resource.
         * GET /projects
         *
         * @return Response
         */
        public function index()
        {
                $pTitle         = "Projects";

                $counter        =       0;
                $user           =       User::find(Auth::id());
                $projects       =       $user->projects()->get();
                $inProjects =  $user->inProjects()->orderBy('created_at', 'desc')->take(5)->get();

                return View::make('projects.index', compact(['projects','inProjects','counter','pTitle']));
        }

        /**
         * Create the new project
         *
         * @return Response
         */
        public function create()
        {
                // Rules
                $rules  = array('name' => 'required',);

                // Create validation
                $validator = Validator::make( Input::all(), $rules);

                if ( $validator->fails() ) {
                        return Redirect::back()->withErrors($validator)->withInput();
                }

                $project                        =       new Project;
                $project->name          =       Input::get('name');
                $project->client_id
