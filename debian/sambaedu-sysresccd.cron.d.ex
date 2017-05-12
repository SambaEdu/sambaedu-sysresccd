#
# Regular cron jobs for the sambaedu-sysresccd package
#
0 4	* * *	root	[ -x /usr/bin/sambaedu-sysresccd_maintenance ] && /usr/bin/sambaedu-sysresccd_maintenance
