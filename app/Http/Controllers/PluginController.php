<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plugin;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use App\Events\UserLog;
use App\Notifications\DownloadNotification;

class PluginController extends Controller
{
    public function index()
    {
        $plugins = Plugin::all();
        return view('dashboard', compact('plugins'));
    }

    public function create()
    {
        return view('dashboard');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'color' => 'required',
            'price' => 'required',
            'habitat' => 'required',

        ]);



        // Create the plugin
        $plugin = Plugin::create($data);

        $log_entry = Auth::user()->name . " added a plugin ". '"' . $plugin->name . '"';
        event(new UserLog($log_entry));

        return redirect()->route('dashboard');
    }

    public function destroy(Plugin $plugin)
    {
        // Delete the plugin record here
        $plugin->delete();
        $log_entry = Auth::user()->name . " deleted a plugin ". '"' . $plugin->name . '"';
        event(new UserLog($log_entry));

        return redirect()->route('plugins.index')->with('success', 'Plugin deleted successfully.');
    }

    public function update(Request $request, Plugin $plugin)
    {
        // Get the current values of the plugin before updating
        $oldName = $plugin->name;
        $oldType = $plugin->type;
        $oldPrice = $plugin->price;
        $oldColor = $plugin->color;
        $oldHabitat = $plugin->habitat;



        // You can add similar lines for other fields as needed

        // Validate and update the plugin's data here
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'price' => $request->input('price'),
            'color' => $request->input('color'),
            'habitat' => $request->input('habitat'),

        ];


        $plugin->update($data);

        $name_updated = false;
        $type_updated = false;
        $price_updated = false;
        $color_updated = false;
        $habitat_updated = false;




        // Create log entry for name update
        $log_entry_name = Auth::user()->name . " updated a plugin name";
        if ($oldName !== $data['name']) {
            $log_entry_name .= ' from "' . $oldName . '" to "' . $data['name'] . '"';
            $name_updated = true;
        }

        // Create log entry for type update
        $log_entry_type = Auth::user()->name . " updated a plugin " . $plugin->name . "'s " . "type";
        if ($oldType !== $data['type']) {
            $log_entry_type .= ' from "' . $oldType . '" to "' . $data['type'] . '"';
            $type_updated = true;
        }

          // Create log entry for price update
          $log_entry_price = Auth::user()->name . " updated a plugin " . $plugin->name . "'s " .  "price";
          if ($oldPrice !== $data['price']) {
              $log_entry_price .= ' from "' . $oldPrice . '" to "' . $data['price'] . '"';
              $price_updated = true;
          }


        // Create log entry for type update
        $log_entry_color = Auth::user()->name . " updated a plugin " . $plugin->name . "'s " . "color";
        if ($oldColor !== $data['color']) {
            $log_entry_color .= ' from "' . $oldColor . '" to "' . $data['color'] . '"';
            $color_updated = true;
        }


         // Create log entry for type update
         $log_entry_habitat = Auth::user()->name . " updated a plugin " . $plugin->name . "'s " . "habitat";
         if ($oldHabitat !== $data['habitat']) {
             $log_entry_habitat .= ' from "' . $oldHabitat . '" to "' . $data['habitat'] . '"';
             $habitat_updated = true;
         }



          if ($name_updated) {
              event(new UserLog($log_entry_name));
          }
          if ($type_updated) {
              event(new UserLog($log_entry_type));
          }
          if ($price_updated) {
              event(new UserLog($log_entry_color));
          }
          if ($color_updated) {
            event(new UserLog($log_entry_price));
        }
        if ($habitat_updated) {
            event(new UserLog($log_entry_habitat));
        }




        return redirect()->route('plugins.index')->with('success', 'Plugin updated successfully.');
    }


    public function download(Request $request, Plugin $plugin){
        $user = User::find(1); // Replace with your notifiable entity retrieval logic

        $user->notify(new DownloadNotification($plugin));

        return redirect()->route('dashboard')->with('success', 'Thanks for downloading! Check your email for details.');

    }



}
