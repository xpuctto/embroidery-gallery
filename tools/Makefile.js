/* global target */

require('shelljs/make');

target.deploy2 = () => {
    const FtpDeploy = require('ftp-deploy');
    const ftpDeploy = new FtpDeploy();

    const config = {
        user: "bgshevit@sandbox.bgshevitsa.eu",                   // NOTE that this was username in 1.x
        password: "yT8RHp.nj~6A",           // optional, prompted if none given
        host: "ftp.bgshevitsa.eu",
        port: 21,
        localRoot: './',
        remoteRoot: '',
        // include: ['*', '**/*'],      // this would upload everything except dot files
        include: [
            'app/**/*.*',
            'artisan',
            'bootstrap/**/*.*',
            'composer.json',
            'composer.lock',
            'config/**/*.*',
            'database/**/*.*',
            'package-lock.json',
            'package.json',
            'phpunit.xml',
            'public/**/*.*',
            'resources/**/*.*',
            'routes/**/*.*',
            'server.php',
            'storage/**/*.*',
            'tests/**/*.*',
            'tools/**/*.*',
            '.htaccess',
        ],
        exclude: ['dist/**/*.map', 'node_modules/**/*.*', 'vendor/**/*.*'],     // e.g. exclude sourcemaps - ** exclude: [] if nothing to exclude **
        deleteRemote: false,              // delete ALL existing files at destination before uploading, if true
        forcePasv: true                 // Passive mode is forced (EPSV command is not sent)
    }

    ftpDeploy.on('uploading', function(data) {
        console.log(data.totalFilesCount);       // total file count being transferred
        console.log(data.transferredFileCount); // number of files transferred
        console.log(data.filename);             // partial path with filename being uploaded
    });

    // use with promises
    ftpDeploy.deploy(config)
        .then(res => console.log('finished:', res))
        .catch(err => console.log(err))
}
