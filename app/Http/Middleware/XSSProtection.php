<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSSProtection
{
    /**
     * The following method loops through all request input and strips out all tags from
     * the request. This to ensure that users are unable to set ANY HTML within the form
     * submissions, but also cleans up input.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array(strtolower($request->method()), ['put', 'post'])) {
            return $next($request);
        }
        
        $input = $request->all();

        // $input = walk($input);

        array_walk_recursive($input, function(&$input) {
            // Encode <, > and & as their HTML5 entity equivalent, leaving quotes, accented
            // and special characters untouched.
            // $input = htmlspecialchars($input, ENT_NOQUOTES | ENT_HTML5);
            // $input = preg_replace('~\r\n?~', "\n", $input);
            $input = is_string($input) && $input !== '' ? strip_tags($input) :  $input;
        });

        $request->merge($input);

        return $next($request);
    }

    private function walk($input) {
        array_walk($input, function(&$input) {
            
            if (!is_array($input)) {
                $input = strip_tags($input);
            } else {
                walk($input);
            }
        });

        return $input;
    }
}
