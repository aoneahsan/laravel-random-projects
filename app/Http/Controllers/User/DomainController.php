<?php

namespace App\Http\Controllers\User;

use Monolog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Domain;
use HieuLe\WordpressXmlrpcClient\WordpressClient;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        $condition = [];

        
        if( isset($request['domain']) && $request['domain'] != '' )
        {
            $condition[] = ['domain', 'like', '%'.$request['domain'].'%'];
        }

        if( isset($request['username']) && $request['username'] != '' )
        {
            $condition[] = ['username', 'like', '%'.$request['username'].'%'];
        }
        
        $domains = Domain::where('user_id', Auth()->user()->id)->where($condition)->latest()->paginate(10);
        return view('dashboard.pages.domains.index', compact('domains'));
    }

    public function create()
    {  
        return view('dashboard.pages.domains.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        # Your Wordpress website is at: http://wp-website.com
        $endpoint = $request->domain_name . '/xmlrpc.php';

        // echo $endpoint;

        # The Monolog logger instance
        $wpLog = new Monolog\Logger('wp-xmlrpc');

        # Create client instance
        $wpClient = new WordpressClient($endpoint, $request->username, $request->password);



        // # Log error
        $wpClient->onError(function($error, $event) use ($wpLog){
            $wpLog->addError($error, $event);
                
        });
        

        # Set the credentials for the next requests
        $result =  $wpClient->setCredentials($endpoint, $request->username, $request->password);

        // dd($confirm_user);


        try {
            $confirm_user =  $wpClient->getUser(array($request->username, $request->password));

            $user =  $wpClient->getProfile(array($request->username, $request->password));

            if ($user == null) {
                return redirect()->back()->with('message', 'Please enter valid wordpress domain, username and passowrd.');
            }

            else {
                $domain = new Domain();
                $domain->user_id = Auth()->user()->id;
                $domain->domain = $request->domain_name;
                $domain->username = $request->username;
                $domain->password = $request->password;
                $domain->save();

                return redirect()->route('user.domain.index')->with('created', 'New domain added successfully!');

            }


        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Please enter valid wordpress domain, username and password.');
        }

    }

    public function edit($id)
    {
        $domain = Domain::findOrFail($id);
        return view('dashboard.pages.domains.edit', compact('domain'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        # Your Wordpress website is at: http://wp-website.com
        $endpoint = $request->domain_name . '/xmlrpc.php';

        // echo $endpoint;

        # The Monolog logger instance
        $wpLog = new Monolog\Logger('wp-xmlrpc');

        # Create client instance
        $wpClient = new WordpressClient($endpoint, $request->username, $request->password);



        // # Log error
        $wpClient->onError(function($error, $event) use ($wpLog){
            $wpLog->addError($error, $event);
                
        });
        

        # Set the credentials for the next requests
        $result =  $wpClient->setCredentials($endpoint, $request->username, $request->password);

        // dd($confirm_user);


        try {
            $confirm_user =  $wpClient->getUser(array($request->username, $request->password));

            $user =  $wpClient->getProfile(array($request->username, $request->password));

            if ($user == null) {
                return redirect()->back()->with('message', 'Please enter valid wordpress domain, username and passowrd.');
            }

            else {
                $domain = Domain::findOrFail($id);
                $domain->user_id = Auth()->user()->id;
                $domain->domain = $request->domain_name;
                $domain->username = $request->username;
                $domain->password = $request->password;
                $domain->save();

                return redirect()->route('user.domain.index')->with('updated', 'Domain updated successfully!');

            }


        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Please enter valid wordpress domain, username and password.');
        }
        
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);
        return view('dashboard.pages.domains.show', compact('domain'));
    }

    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        $domain->delete();

        return redirect()->back()->with('deleted', 'Domain deleted successfully!');

    }
}
