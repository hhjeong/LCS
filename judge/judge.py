#!/usr/bin/python
# -*- coding: utf-8 -*-

import MySQLdb, differs, logging, time
import glob, sys, os
from termcolor import colored, cprint


logging.basicConfig(level=logging.DEBUG, format=colored('%(asctime)s %(levelname)s ',"green") + '%(message)s')

class Judge:

	def __init__(self):
		self.db = MySQLdb.connect('localhost','libe','Hvb4Ap4tKuGCwQvt','libe')
	
		cur = self.db.cursor()
		cur.execute("SELECT pid, differ, answer FROM bud13_problemset")

		self.differ = dict()
		self.answer = dict()
		for row in cur.fetchall():
			self.differ[row[0]] = differs.modules[row[1]]
			self.answer[row[0]] = row[2]	

	
	def fetch_lastest(self):
		cur = self.db.cursor(MySQLdb.cursors.DictCursor)
		cur.execute("SELECT * FROM bud13_status WHERE result = 'PENDING' ORDER BY run_id ASC")

		self.db.commit()
		if int(cur.rowcount) == 0:
			return None
		else:
			return cur.fetchone()

	def judge_lastest(self):
		lastest = self.fetch_lastest()
		if lastest is None:
			# logging.info("No submissions")
			return

		submission_id = lastest['run_id']
		team_id = lastest['team_id']
		problem_id = lastest['pid']
		solution_path = "../" + lastest['output']	

		logging.info("Fetching run_id %s, %s, problem %s" % (submission_id, team_id, problem_id ) )
		result = "YES" if self.differ[problem_id].judge( "", "", solution_path, self.answer[problem_id] ) else "NO"
		
		query = "UPDATE bud13_status SET result = '%s' WHERE run_id = %s" % (result,submission_id)

		cur = self.db.cursor()
		cur.execute( query )
		updated = cur.rowcount != 0
		self.db.commit()

		if result == "YES":
			result = colored(result,"green")
		else:
			result = colored(result, "red" )
		logging.info( "Response of run_id %s : %s (%s)" % ( submission_id, result, str(updated) ) )

		# self.update_board()

	def update_board(self):
		os.system('php ../standing.php > ../standing.html')
		os.system('php ../s_team.php > ../s_team.html')
		os.system('php ../s_single.php > ../s_single.html')


	def run(self):
		# self.update_board()
		while True:
			self.judge_lastest()
			time.sleep(1)

def main():

	for pid_path in glob.glob('/proc/[0-9]*/'):
		if "./judge.py" in open(pid_path+'/cmdline').read():
			if pid_path != "/proc/%d/" % os.getpid():
				print >> sys.stderr, colored("Error ","red") + ": Another runner already exist!"
				exit()
	judge = Judge()
	judge.run()

if __name__ == "__main__":
	main()
